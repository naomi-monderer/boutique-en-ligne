<?php
require_once('../controllers/AdminController.php');
require_once('include/header.php');
?>
<main class="main-bo">
    <section>
        <?php require_once('include/sideBar.php')?>
    </section>
</main>
<?php
/* This button allow the admin to display modify and delete these users*/
if(isset($_GET['display_user']))
{ 
    header('location: admin_user.php');
} 
/* This button allow the admin to register articles*/
if(isset($_GET['display_article']))
{
    header('location: admin_article.php');
}
/* This button allow the admin to register articles*/
if(isset($_GET['display_select_list']))
{
    header('location: admin_options.php');
}
if(isset($_GET['tab_articles']))
{
    header('location: admin_tab_articles.php');
}
if(isset($_GET['manage_specificities']))
{
    header('location: admin_manage_other_forms.php');
}
if(isset($_GET['update_article']))
{
    header('location: admin_update_article.php');
}
require_once('include/footer.php');
?>