<?php
if (!isset($_SESSION['logged_in'])) header("Location: " . BASEURL);
?>
<main class="layout">
    <div class="bg-main"></div>
    <div class="position-absolute start-50 top-50 translate-middle text-white">
        <h3 class="fs-1 text-center mb-4">
            Your Shipment is Our
            <br /><span class="typer text-white" id="main" data-words="Priority!,Responsible!" data-delay="100" data-deleteDelay="1000"></span>
            <span class="cursor" data-owner="main"></span>
        </h3>
        <div class="d-flex justify-content-around flex-column d-sm-flex flex-md-row">
            <button class="btn btn-outline-warning mb-3 mb-md-0">
                Get Started
            </button>
            <button class="btn btn-warning">Discover More</button>
        </div>
    </div>
</main>

<script>
    // trigger navbar changing background to dark when scrolling page
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        const navbar = document.getElementById("navbar");
        if (
            document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20
        ) {
            navbar.classList.add("bg-dark");
        } else {
            navbar.classList.remove("bg-dark");
        }
    }
</script>