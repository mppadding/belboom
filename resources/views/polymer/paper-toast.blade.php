{{--
    Copyright (C) Matthijs Padding - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Written by Matthijs Padding <mppadding@gmail.com>, May 2015
--}}

<paper-toast id="toast" text="{{ $message }}"></paper-toast>

<script>
    toast = document.getElementById("toast");
	
	if(toast.currentToast) {
	    toast.currentToast.dismiss();
	}
	
	toast.currentToast = this;
	toast.opened = true;
</script>