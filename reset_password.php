<?php
/**
 * SIMPEL BPVP Kendari
 */
?>
<!DOCTYPE html>
<html>
<head>
  <base target="_top">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; background-color:#eef2ff; }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

  <div class="w-full max-w-sm md:max-w-md bg-white rounded-2xl shadow-2xl p-6 sm:p-8">
    <div class="text-center mb-6">
      <div class="flex justify-center mb-3">
        <img src="https://bpvpkendari.kemnaker.go.id/storage/upload/setting/11749712002.png"
             class="h-20 w-20 object-contain rounded-lg border-2 border-white bg-white p-1" />
      </div>
      <h2 class="text-2xl font-extrabold text-gray-900">Reset Password</h2>
      <p class="text-sm text-gray-600 mt-1">Masukkan password baru Anda.</p>
    </div>

    <input type="hidden" id="token" value="<?= RESET_TOKEN ?>">

    <div class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Password baru</label>
        <input id="newPass" type="password"
          class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg"
          placeholder="minimal 6 karakter">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Ulangi password</label>
        <input id="newPass2" type="password"
          class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg"
          placeholder="konfirmasi password">
      </div>

      <button id="btnReset"
        class="w-full flex justify-center py-3 px-4 rounded-lg shadow-lg text-base font-semibold text-white bg-indigo-600 hover:bg-indigo-700 transition duration-200"
        onclick="doReset()">
        Simpan Password Baru
      </button>

      <p id="msg" class="text-sm text-center"></p>

      <a class="block text-center text-sm font-medium text-indigo-600 hover:text-indigo-500"
         href="<?= ScriptApp.getService().getUrl() ?>?page=index">
        Kembali ke Login
      </a>
    </div>
  </div>

<script>
function setBtnLoading(isLoading){
  const btn = document.getElementById('btnReset');
  if(isLoading){
    btn.disabled = true;
    btn.classList.add('opacity-70','cursor-not-allowed');
    btn.innerText = 'Memproses...';
  } else {
    btn.disabled = false;
    btn.classList.remove('opacity-70','cursor-not-allowed');
    btn.innerText = 'Simpan Password Baru';
  }
}

function doReset(){
  const token = document.getElementById('token').value.trim();
  const p1 = document.getElementById('newPass').value;
  const p2 = document.getElementById('newPass2').value;
  const msg = document.getElementById('msg');

  msg.className = 'text-sm text-center';
  if(!token){ msg.classList.add('text-red-600'); msg.textContent='Token tidak ditemukan.'; return; }
  if(p1.length < 6){ msg.classList.add('text-red-600'); msg.textContent='Password minimal 6 karakter.'; return; }
  if(p1 !== p2){ msg.classList.add('text-red-600'); msg.textContent='Konfirmasi password tidak sama.'; return; }

  setBtnLoading(true);
  msg.textContent = '';

  google.script.run
    .withSuccessHandler(res=>{
      setBtnLoading(false);
      if(res.status === 'success'){
        msg.classList.add('text-green-700');
      } else {
        msg.classList.add('text-red-600');
      }
      msg.textContent = res.message;
    })
    .withFailureHandler(err=>{
      setBtnLoading(false);
      msg.classList.add('text-red-600');
      msg.textContent = 'Gagal reset password.';
      console.error(err);
    })
    .resetPasswordWithToken(token, p1);
}
</script>

</body>
</html>
