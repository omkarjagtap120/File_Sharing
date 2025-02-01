<?php include 'partials/header.php'; ?>

<div class="container">
    <div class="card">
        <div class="upload-box">
            <form action="upload.php" method="POST" enctype="multipart/form-data" class="space-y-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                
                <input type="file" name="file" id="fileInput" class="hidden" required>
                <label for="fileInput" class="cursor-pointer bg-blue-100 text-blue-600 px-6 py-2 rounded-lg hover:bg-blue-200 transition">
                    Choose File
                </label>
                <span id="fileName" class="text-gray-600"></span>
                
                <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-lg hover:bg-blue-600 transition transform hover:scale-105">
                    Upload File
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-4">Download File</h2>
            <form action="download.php" method="GET" class="flex gap-4 justify-center">
                <input type="text" name="code" 
                    class="border-2 border-blue-200 px-4 py-2 rounded-lg w-64 text-center"
                    placeholder="Enter 6-digit code" 
                    maxlength="6"
                    pattern="\d{6}"
                    required>
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition">
                    Download
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('fileInput').addEventListener('change', function(e) {
    const fileName = document.getElementById('fileName');
    fileName.textContent = e.target.files[0].name;
});
</script>

<?php include 'partials/footer.php'; ?>
