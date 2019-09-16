import $ from 'jquery';
class Category {
    constructor() {
        this.categoryCheckbox = $('.category_checkbox')
        this.categorySelectTimeout = undefined;
        this.productContent = $('.content__right');
        this.currentlySelected = $('.category_checkbox:checked')
        this.loadingScreen = $('<div>').addClass('categories_loading')
            .append('<div class="spinner-loader"><i class="fa fa-circle-o-notch" aria-hidden="true"></i></div>')
        this.init();
    }
    init() {
        this.categoryCheckbox.on('change', this.handleCategoryClick.bind(this))
    }
    handleCategoryClick() {
        clearInterval(this.categorySelectTimeout);
        this.currentlySelected = $('.category_checkbox:checked')
        this.categorySelectTimeout = setTimeout(() => {
            this.initiateSearch();
        }, 750)
    }
    initiateSearch() {

        let catIDs = '';
        this.productContent.append(this.loadingScreen);
        $.each(this.currentlySelected, (i, el) => {
            catIDs += el.getAttribute('value') + ',';
        })
        const requestString = catIDs.substring(0, catIDs.length - 1);


        // $.getJSON(`${siteData.site_url}/wp-json/boot/v1/category?catids=${requestString}`)
        //     .done(results => {                
        //         this.displayResults(results);
        //     })
        //     .fail(() => {
        //         $('.categories_loading').remove();
        //         console.log('there was an issue connecting to the endpoint')
        //     })

        // $('#category_filter').submit(e => {
        //     e.preventDefault();
        //     console.log('happening')
        const filter = $('#category_filter');
            $.ajax({
                url: `${siteData.site_url}/wp-admin/admin-ajax.php`,
                data: filter.serialize(), // form data
                type: filter.attr('method'), // POST
                beforeSend: (xhr) => {
                    console.log("will send")
                    filter.find('button').text('Processing...'); // changing the button label
                },
                success:  data => {
                    console.log("data",data)
                   this.loadingScreen.remove()
                    $('.products').html(data); // insert data
                    
                },
                fail: error => {
                    console.log("error", error)
                }
            });

    }

}
export default Category