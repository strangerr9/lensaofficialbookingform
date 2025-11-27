@extends('layouts.app')

@section('content')
<div class="container text-center" style="margin-top:100px;">
    <!-- Hidden modal -->
    <div id="successModal" class="modal" tabindex="-1" role="dialog" style="display:block;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-4">
          <h5 class="modal-title mb-3">Booking Successful!</h5>
          <p>Your booking code: <strong>{{ session('booking_code') }}</strong></p>
          <button id="okBtn" class="btn btn-primary">OK</button>
        </div>
      </div>
    </div>
</div>

<script>
document.getElementById('okBtn').addEventListener('click', function() {
    window.location.href = "/booking/create";  // Redirect to blank form
});
</script>
@endsection
