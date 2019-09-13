import $ from 'jquery';
import { tween, styler, spring } from 'popmotion';

class Search {
    constructor() {
        this.modal = $('#search-form');
        this.modal_POP = styler(document.getElementById('search-form'));
        this.searchTrigger = $('#header-search');
        this.closeTrigger = $('.search-form__close');
        this.searchInput = $('#header-search');
        this.searchInputHolder = $('#main-menu__search')
        this.results = $('.search-form__results');
        this.body = $('body');
        this.isOpen = false;
        this.searchTimer = undefined;
        this.savedSearchValue = '';
        this.focusTimeout = undefined;
        this.headerHeight = $('.site-header').innerHeight();
        this.leftOverBodyHeight = $(window).innerHeight() - this.headerHeight;
        this.init();
    }

    init() {
        this.closeTrigger.on('click', this.closeSearch.bind(this));
        $(document).on('keydown', this.handleKeyDown.bind(this));
        this.searchInput.on('keyup', this.handleSearchInput.bind(this));

    }

    openSearch() {
        console.log("height", this.leftOverBodyHeight);
        this.body.addClass('no-scroll')
        const yVal = ($('#wpadminbar').length > 0) ? this.headerHeight + 32 : this.headerHeight;
        if (!this.isOpen) {
            spring({
                from: { x: '-100%', y: `${yVal}px`, height: '0px' },
                to: { x: '0%', y: `${yVal}px`, height: `${this.leftOverBodyHeight}px` },
                stiffness: 250,
                damping: 20
            }).start(v => this.modal_POP.set(v));
        }
        this.isOpen = true;
    }

    closeSearch() {
        this.body.removeClass('no-scroll')

        this.searchInput.val('');
        this.results.html('')
        if (this.isOpen) {
            tween({ to: '-100%', duration: 300 })
                .start(v => this.modal_POP.set('x', v));
        }
        this.isOpen = false;
    }
    handleKeyDown(e) {

        if (e.keyCode === 83 && !this.isOpen) {
            this.openSearch();
        }
        if (e.keyCode === 27 && this.isOpen) {
            this.closeSearch();
        }
    }
    handleSearchInput(e) {
        if (this.savedSearchValue !== this.searchInput.val()) {
            clearTimeout(this.searchTimer);

            if (this.searchInput.val() !== '' && this.searchInput.val().length > 2) {
                if (!$('.spinner-loader').length) {
                    this.searchInputHolder.append('<div class="spinner-loader"><i class="fa fa-circle-o-notch" aria-hidden="true"></i></div>')
                    this.results.html('<div class="spinner-loader"><i class="fa fa-circle-o-notch" aria-hidden="true"></i></div>')
                }
                this.searchTimer = setTimeout(this.getResults.bind(this), 500);
            } else if (this.searchInput.val() === '') {
                $('.spinner-loader').remove();
                this.results.html('');
                this.closeSearch();
            } else {
                this.results.html('Type More');
            }
        }
        this.savedSearchValue = this.searchInput.val();
    }

    getResults() {
        $.getJSON(`${siteData.site_url}/wp-json/boot/v1/search?term=${this.searchInput.val()}`)
            .done(results => {
                $('.spinner-loader').remove();
                this.openSearch();
                console.log(results);
                this.organizeResults(results)
            })
            .fail(error => {
                console.log("ERROR", error)
                const $errorText = `<p class="error">A website error has occured: ${error.statusText}</p>`;
                this.results.html($errorText);
            });
    }

    organizeResults(results) {
        const { post = [], page = [], product = [] } = results
        const resultsContainer = $('<div>').addClass('results-container container')
        const resultsRow = $('<div>').addClass('row')
        const productCol = this.displayFullColumn(product, 'Products');
        const postCol = this.displayHalfColumn(post, 'Latest Posts')
        const pageCol = this.displayHalfColumn(page, 'Pages')

        resultsRow.append(productCol, postCol, pageCol);
        resultsContainer.append(resultsRow)

        this.results.html(resultsContainer);
    }

    displayFullColumn(result, title) {

        let resultDisplay = `
            <div class="product-results">
            <h2>${title}</h2>
            <div class="product-results__holder">
        `;
        if (result.length > 0) {
            result.forEach(el => {

                const imageUrl = (el.featured_image.length > 0) ? el.featured_image : siteData.small_product_placeholder_url;

                const price = (el.sale_price.length > 0) ? `<span class="strike">$${el.reg_price}</span> $${el.sale_price}` : `$${el.price}`;

                resultDisplay += `
                <div class="product-results__item">
                <a href="${el.link}" title="${el.title}">
                    <div class="product-results__item-inner">
                        <img src="${imageUrl}" alt="${el.title} preview image" />
                        <div>                     
                            <h4 class="product-results__title">${el.title}</h4>
                            <p class="product-results__price">${price}</p>                      
                        </div>
                    </div>
                    </a>
                </div>        
            `;
            });
        } else {
            resultDisplay += `<p>No results found for "${this.searchInput.val()}" in ${title}</p>`
        }

        resultDisplay += `
        </div> <!-- .product-results__holder -->
        </div> <!-- .product-results -->
        `;

        return $(resultDisplay);
    }

    displayHalfColumn(result, title) {

        let resultDisplay = `
        <div class="product-results">
        <h2>${title}</h2>
        <div class="product-results__holder">
    `;
        if (result.length > 0) {
            result.forEach(el => {

                const imageUrl = (el.featured_image.length > 0) ? el.featured_image : siteData.small_product_placeholder_url;

                resultDisplay += `
            <div class="product-results__item">
            <a href="${el.link}" title="${el.title}">
                <div class="product-results__item-inner">
                    <img src="${imageUrl}" alt="${el.title} preview image" />
                    <div>                     
                        <h4 class="product-results__title">${el.title}</h4>
                        <p class="product-results__price">${el.author_name}</p>                      
                    </div>
                </div>
                </a>
            </div>        
        `;
            });
        } else {
            resultDisplay += `<p>No results found for "${this.searchInput.val()}" in ${title}</p>`
        }

        resultDisplay += `
    </div> <!-- .product-results__holder -->
    </div> <!-- .product-results -->
    `;

        return $(resultDisplay);
    }
}

export default Search;

//main-search-form--visible