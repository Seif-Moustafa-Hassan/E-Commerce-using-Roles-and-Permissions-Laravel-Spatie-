@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="text-center my-4">
        <h2 id="statusMessage">Update in progress...</h2>

        <!-- Progress bar container -->
        <div class="progress mt-4" style="height: 30px;">
            <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" 
                 role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                0%
            </div>
        </div>
    </div>

</div>

<script>
    const statusUrl = "{{ route('products.status.check') }}";

    // Optional: total number of products to calculate progress
    const totalProducts = {{ \DB::table('products')->count() }}; // fetch total count from DB

    function checkStatus() {
        fetch(statusUrl + '?t=' + new Date().getTime(), { cache: "no-store" })
            .then(res => res.json())
            .then(data => {
                console.log("STATUS:", data.status);

                const progressBar = document.getElementById('progressBar');

                if (data.status === 'processing') {
                    // Optional: If you also store 'processed_count' in cache, calculate exact %
                    // Here we simulate progress by incrementing every poll
                    let currentWidth = parseInt(progressBar.style.width);
                    if (currentWidth < 95) currentWidth += 5; // increment smoothly
                    progressBar.style.width = currentWidth + '%';
                    progressBar.innerText = currentWidth + '%';

                    setTimeout(checkStatus, 2000);
                } 
                else if (data.status === 'done') {
                    // Fill to 100%
                    progressBar.style.width = '100%';
                    progressBar.innerText = '100%';
                    document.getElementById('statusMessage').innerText = 'Updated Successfully';
                    progressBar.classList.remove('progress-bar-animated');
                } 
                else {
                    // idle or unknown
                    progressBar.style.width = '0%';
                    progressBar.innerText = '0%';
                }
            })
            .catch(err => console.error(err));
    }

    checkStatus();
</script>
@endsection