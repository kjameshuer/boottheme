<footer class="site_footer container-fluid">
    <div class="footer-widgets-holder container">
        <div class="row">
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="col-4">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>
            <?php if (is_active_sidebar('footer-2')) : ?>
                <div class="col-4">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
            <?php endif; ?>
            <?php if (is_active_sidebar('footer-3')) : ?>
                <div class="col-4">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
            <?php endif; ?>
        </div>

        <div>
</footer>

<?php wp_footer(); ?>

</body>

</html>