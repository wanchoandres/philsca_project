<?php if (session()->get('danger')): ?>
    <div class="bs-toast toast bg-danger shadow-lg border-0" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%);" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="px-3 py-2">
            <span class="px-3 text-white"><?= session()->get('danger'); ?></span>
        </div>
    </div>
<?php endif; ?>


<?php if (session()->get('success')): ?>
    <div class="bs-toast toast bg-success shadow-lg border-0" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%);" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="px-3 py-2">
            <span class="px-3 text-white"><?= session()->get('success'); ?></span>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->get('warning')): ?>
    <div class="bs-toast toast bg-warning shadow-lg border-0" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%);" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="px-3 py-2">
            <span class="px-3 text-white"><?= session()->get('warning'); ?></span>
        </div>
    </div>
<?php endif; ?>


<script>
    setTimeout(function () {
        var toastElement = document.querySelector('.toast');
        var toast = new bootstrap.Toast(toastElement);
        toast.show(); // Show the toast
        setTimeout(function () {
            toast.hide(); // Hide the toast
        }, 3000); // Hide after 30 seconds
    }, 99); // Show after 99 milliseconds
</script>