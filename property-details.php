<?php
// Load configuration
require_once 'config/config.php';

// Include header
include 'views/layout/header.php';
?>

<main class="main-content">

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar filter -->
            <aside class="col-lg-3 col-md-4">
                <?php include 'views/sections/filter.php'; ?>
            </aside>

            <!-- Lands listing -->
            <section class="col-lg-9 col-md-8">
                <?php include 'views/sections/lands-sale.php'; ?>
            </section>

        </div>
    </div>

</main>

<?php 
// Include footer
include 'views/layout/footer.php'; 
?>
