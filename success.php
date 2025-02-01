<?php include 'partials/header.php'; ?>

<div class="container">
    <div class="success-card">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-success mx-auto" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        
        <h1 class="text-2xl font-bold mt-4 mb-2">Upload Successful!</h1>
        <p class="text-gray-600">Your file is ready to share</p>
        
        <div class="download-code">
            <?= isset($_GET['code']) ? htmlspecialchars($_GET['code']) : '' ?>
        </div>

        <div class="mt-6">
            <p class="text-gray-600 mb-4">Share this code with others to download the file</p>
            <button onclick="copyCode()" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                Copy Code
            </button>
            <a href="index.php" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition ml-4">
                Home
            </a>
        </div>

        <div class="mt-8 animate-float">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500 mx-auto" viewBox="0 0 24 24" fill="currentColor">
               <path fill-rule="evenodd" d="M12 2a10 10 0 100 20 10 10 0 000-20zm-1 14.293l-3.293-3.293a1 1 0 111.414-1.414L11 13.586l4.879-4.879a1 1 0 111.414 1.414L11 16.293a1 1 0 01-1.414 0z" clip-rule="evenodd" />
             </svg>
        </div>
    </div>
</div>

<script>
function copyCode() {
    navigator.clipboard.writeText(document.querySelector('.download-code').textContent)
        .then(() => alert('Code copied to clipboard!'))
        .catch(() => alert('Failed to copy code'));
}
</script>

<?php include 'partials/footer.php'; ?>