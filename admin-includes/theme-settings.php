<?php
//ADMIN
function theme_settings_page()
{
    ?>
    <h1>Boot Theme Settings</h1>
    <form method="post" action="options.php">
        <?php
            settings_fields("section");
            do_settings_sections("theme-options");
            submit_button();
            ?>
    </form>
<?php
}

function boot_admin_init()
{
    add_menu_page("Boot Theme Options", "Boot Theme Settings", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

add_action('admin_menu', 'boot_admin_init');
