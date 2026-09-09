/**
 * SIMPEL BPVP Kendari - Backend Google Apps Script
 *
 * Setup:
 * 1. Tempel file ini ke Apps Script sebagai Code.gs.
 * 2. Jika project terikat pada Google Sheet, biarkan SPREADSHEET_ID kosong.
 * 3. Jika project berdiri sendiri, isi Script Properties: SPREADSHEET_ID.
 * 4. Pastikan nama sheet utama mengikuti MODULE_SHEETS atau ubah konfigurasinya.
 */

var CONFIG = {
  ACTIVE_YEAR: 2026,
  SPREADSHEET_ID: PropertiesService.getScriptProperties().getProperty('SPREADSHEET_ID') || '',
  SESSION_SECONDS: 21600,
  SHEETS: {
    USERS: 'Users',
    PROGRAM: 'program_pelatihan',
    SERTIFIKASI: 'sertifikasi',
    PENEMPATAN: 'penempatan',
    BNBA: 'bnba',
    PRODUKTIVITAS: 'produktivitas',
    UPTD_KOLAKA: 'uptd_kolaka',
    UPTD_KOLAKA_UTARA: 'uptd_kolaka_utara',
    UPTD_KONAWE_SELATAN: 'uptd_konawe_selatan',
    UPTD_KONAWE_UTARA: 'uptd_konawe_utara',
    UPTD_BUTON: 'uptd_buton',
    PENGADAAN: 'pengadaan',
    PEMBAYARAN: 'pembayaran',
    TARGET: 'target_realisasi',
    JENIS: 'jenis_pelatihan',
    ANGGARAN: 'realisasi_anggaran'
  }
};

var HEADERS = {
  Users: ['email', 'password_hash', 'fullName', 'role', 'active', 'createdAt'],
  program_pelatihan: ['NO', 'KEJURUAN', 'PROGRAM PELATIHAN', 'JENIS PELATIHAN', 'TARGET PESERTA', 'JUMLAH PESERTA PELATIHAN', 'PEREMPUAN', 'LAKI-LAKI', 'TGL MASUK', 'TGL MULAI PELATIHAN', 'TGL SELESAI PELATIHAN', 'BULAN MULAI PELATIHAN', 'LULUS', 'TIDAK LULUS', 'STATUS ALUR', 'TAHUN'],
  sertifikasi: ['No', 'Skema', 'TUK', 'Tahap', 'Tanggal Pendaftaran', 'Nama Lengkap', 'Nomor KTP', 'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'Alamat Rumah', 'Nomor Telepon', 'Alamat Email', 'Kualifikasi pendidikan', 'Kebangsaan', 'Asesor', 'Form APL 01 & 02', 'Hasil UJK', 'Cetak Sertifikat', 'TAHUN'],
  penempatan: ['No', 'Kejuruan', 'Jumlah Peserta Pelatihan', 'Total Penempatan', 'Ditempatkan / Bekerja', 'Tidak Ditempatkan', 'Berwirausaha', 'Nama Perusahaan', 'Sektor', 'Jumlah Alumni Yang Ditempatkan', 'TAHUN'],
  bnba: ['Name', 'Gender', 'Kabupaten/Kota', 'Pendidikan', 'Name Program Pelatihan', 'Name Kejuruan', 'Lulus/ Tidak Lulus', 'Bekerja', 'Perusahaan/Instansi/Usaha', 'TAHUN'],
  produktivitas: ['Peserta', 'Jumlah', 'Nama Perusahaan', 'Alamat Perusahaan', 'Tanggal Kegiatan', 'Sektor', 'TAHUN'],
  uptd_kolaka: ['NO', 'KEJURUAN', 'PROGRAM PELATIHAN', 'JUMLAH PESERTA PELATIHAN', 'PEREMPUAN', 'LAKI-LAKI', 'S1/D4', 'D3', 'SMA / SMK', 'SMP', 'SD', 'DISABILITAS', 'U 17-24', 'U 25-28', 'U 29-34', 'U 35-40', 'U 41-dst', 'TAHUN'],
  uptd_kolaka_utara: ['NO', 'KEJURUAN', 'PROGRAM PELATIHAN', 'JUMLAH PESERTA PELATIHAN', 'PEREMPUAN', 'LAKI-LAKI', 'S1/D4', 'D3', 'SMA / SMK', 'SMP', 'SD', 'DISABILITAS', 'U 17-24', 'U 25-28', 'U 29-34', 'U 35-40', 'U 41-dst', 'TAHUN'],
  uptd_konawe_selatan: ['NO', 'KEJURUAN', 'PROGRAM PELATIHAN', 'JUMLAH PESERTA PELATIHAN', 'PEREMPUAN', 'LAKI-LAKI', 'S1/D4', 'D3', 'SMA / SMK', 'SMP', 'SD', 'DISABILITAS', 'U 17-24', 'U 25-28', 'U 29-34', 'U 35-40', 'U 41-dst', 'TAHUN'],
  uptd_konawe_utara: ['NO', 'KEJURUAN', 'PROGRAM PELATIHAN', 'JUMLAH PESERTA PELATIHAN', 'PEREMPUAN', 'LAKI-LAKI', 'S1/D4', 'D3', 'SMA / SMK', 'SMP', 'SD', 'DISABILITAS', 'U 17-24', 'U 25-28', 'U 29-34', 'U 35-40', 'U 41-dst', 'TAHUN'],
  uptd_buton: ['NO', 'KEJURUAN', 'PROGRAM PELATIHAN', 'JUMLAH PESERTA PELATIHAN', 'PEREMPUAN', 'LAKI-LAKI', 'S1/D4', 'D3', 'SMA / SMK', 'SMP', 'SD', 'DISABILITAS', 'U 17-24', 'U 25-28', 'U 29-34', 'U 35-40', 'U 41-dst', 'TAHUN'],
  pengadaan: ['ID', 'PROGRAM / BATCH', 'JENIS', 'NAMA ALAT / BAHAN', 'JUMLAH', 'SATUAN', 'PERKIRAAN NILAI', 'SPESIFIKASI', 'STATUS', 'TAHUN', 'createdAt'],
  pembayaran: ['ID', 'PROGRAM / BATCH', 'PESERTA', 'NILAI PENGAJUAN', 'STATUS PEMBAYARAN', 'TANGGAL PENGAJUAN', 'TANGGAL BAYAR', 'CATATAN', 'TAHUN', 'updatedAt'],
  target_realisasi: ['JENIS PELATIHAN', 'TARGET', 'REALISASI', 'TAHUN'],
  jenis_pelatihan: ['PROGRAM PELATIHAN', 'TARGET', 'REALISASI', 'TAHUN'],
  realisasi_anggaran: ['URAIAN', 'TARGET', 'REALISASI', 'PERSENTASE', 'TAHUN']
};

var MODULE_TO_SHEET = {
  program_pelatihan: 'program_pelatihan',
  sertifikasi: 'sertifikasi',
  penempatan: 'penempatan',
  bnba: 'bnba',
  produktivitas: 'produktivitas',
  uptd_kolaka: 'uptd_kolaka',
  uptd_kolaka_utara: 'uptd_kolaka_utara',
  uptd_konawe_selatan: 'uptd_konawe_selatan',
  uptd_konawe_utara: 'uptd_konawe_utara',
  uptd_buton: 'uptd_buton',
  pengadaan: 'pengadaan',
  pembayaran: 'pembayaran'
};

function doGet(e) {
  e = e || { parameter: {} };
  var page = e.parameter.page || 'index';
  var allowed = ['index', 'portal', 'dashboard', 'pelatihan', 'pelatihan_uptd', 'sertifikasi', 'produktivitas', 'penempatan', 'umum', 'input', 'input_penyelenggara', 'input_pemberdayaan', 'input_umum', 'input_produktivitas', 'input_lsp', 'pengadaan', 'keuangan', 'reset_password'];
  if (allowed.indexOf(page) === -1) page = 'index';

  var template = HtmlService.createTemplateFromFile(page);
  template.ACTIVE_YEAR = Number(e.parameter.year || CONFIG.ACTIVE_YEAR);
  template.AUTH_TOKEN = e.parameter.token || '';
  template.APP_URL = ScriptApp.getService().getUrl();
  return template.evaluate()
    .setTitle('SIMPEL BPVP Kendari')
    .setXFrameOptionsMode(HtmlService.XFrameOptionsMode.ALLOWALL);
}

function include(filename) {
  return HtmlService.createHtmlOutputFromFile(filename).getContent();
}

function getSpreadsheet_() {
  if (CONFIG.SPREADSHEET_ID) return SpreadsheetApp.openById(CONFIG.SPREADSHEET_ID);
  var active = SpreadsheetApp.getActiveSpreadsheet();
  if (!active) throw new Error('Spreadsheet belum terhubung. Isi Script Property SPREADSHEET_ID.');
  return active;
}

function getOrCreateSheet_(name, headers) {
  var ss = getSpreadsheet_();
  var sheet = ss.getSheetByName(name);
  if (!sheet) sheet = ss.insertSheet(name);
  if (sheet.getLastRow() === 0 && headers && headers.length) sheet.getRange(1, 1, 1, headers.length).setValues([headers]);
  return sheet;
}

function getSheet_(name) {
  var sheet = getSpreadsheet_().getSheetByName(name);
  if (!sheet) throw new Error('Sheet tidak ditemukan: ' + name);
  return sheet;
}

function headerRow_(sheet) {
  var lastColumn = Math.max(sheet.getLastColumn(), 1);
  return sheet.getRange(1, 1, 1, lastColumn).getDisplayValues()[0].map(function (v) { return String(v).trim(); });
}

function ensureHeaders_(sheetName) {
  var sheet = getSpreadsheet_().getSheetByName(sheetName);
  if (!sheet) return getOrCreateSheet_(sheetName, HEADERS[sheetName] || []);
  if (sheet.getLastRow() === 0 && HEADERS[sheetName]) sheet.getRange(1, 1, 1, HEADERS[sheetName].length).setValues([HEADERS[sheetName]]);
  return sheet;
}

function rowToObject_(headers, values, rowIndex) {
  var result = { _rowIndex: rowIndex };
  headers.forEach(function (header, index) {
    if (header) result[header] = values[index];
  });
  return result;
}

function sheetRecords_(sheetName, year) {
  var sheet = ensureHeaders_(sheetName);
  if (sheet.getLastRow() < 2) return [];
  var headers = headerRow_(sheet);
  var rows = sheet.getRange(2, 1, sheet.getLastRow() - 1, headers.length).getDisplayValues();
  var yearText = year ? String(year) : '';
  return rows.map(function (row, index) { return rowToObject_(headers, row, index + 2); }).filter(function (record) {
    if (!yearText) return true;
    var recordYear = record.TAHUN || record.Year || record.YEAR || '';
    return !recordYear || String(recordYear) === yearText;
  });
}

function objectToRow_(headers, values) {
  return headers.map(function (header) {
    return values[header] === undefined || values[header] === null ? '' : values[header];
  });
}

function appendRecord_(sheetName, values) {
  var sheet = ensureHeaders_(sheetName);
  var headers = headerRow_(sheet);
  sheet.appendRow(objectToRow_(headers, values));
  return { status: 'success', message: 'Data berhasil disimpan.', rowIndex: sheet.getLastRow() };
}

function updateRecord_(sheetName, rowIndex, values) {
  var sheet = ensureHeaders_(sheetName);
  if (!rowIndex || Number(rowIndex) < 2 || Number(rowIndex) > sheet.getLastRow()) throw new Error('Baris data tidak valid.');
  var headers = headerRow_(sheet);
  var current = sheet.getRange(Number(rowIndex), 1, 1, headers.length).getValues()[0];
  var currentObject = rowToObject_(headers, current, rowIndex);
  Object.keys(values || {}).forEach(function (key) { currentObject[key] = values[key]; });
  sheet.getRange(Number(rowIndex), 1, 1, headers.length).setValues([objectToRow_(headers, currentObject)]);
  return { status: 'success', message: 'Data berhasil diperbarui.', rowIndex: Number(rowIndex) };
}

function deleteRecord_(sheetName, rowIndex) {
  var sheet = ensureHeaders_(sheetName);
  if (!rowIndex || Number(rowIndex) < 2 || Number(rowIndex) > sheet.getLastRow()) throw new Error('Baris data tidak valid.');
  sheet.deleteRow(Number(rowIndex));
  return { status: 'success', message: 'Data berhasil dihapus.' };
}

function value_(object, names) {
  for (var i = 0; i < names.length; i++) {
    if (object[names[i]] !== undefined && object[names[i]] !== '') return object[names[i]];
  }
  return '';
}

function number_(value) {
  if (typeof value === 'number') return value;
  var cleaned = String(value || '').replace(/[^0-9,.-]/g, '').replace(/\./g, '').replace(',', '.');
  var result = Number(cleaned);
  return isNaN(result) ? 0 : result;
}

function sumField_(records, names) {
  return records.reduce(function (sum, row) { return sum + number_(value_(row, names)); }, 0);
}

function formatDate_(value) {
  if (!value) return '';
  if (Object.prototype.toString.call(value) === '[object Date]') return Utilities.formatDate(value, Session.getScriptTimeZone(), 'yyyy-MM-dd');
  return String(value);
}

function normalizeRole_(role) {
  var value = String(role || 'umum').toLowerCase().trim();
  var aliases = { leader: 'pimpinan', pimpinan: 'pimpinan', admin: 'admin', administrator: 'admin', pokja: 'pokja', 'pejabat pengadaan': 'pokja', keuangan: 'keuangan', penyelenggara: 'penyelenggara', pemberdayaan: 'pemberdayaan', umum: 'umum', produktivitas: 'produktivitas', lsp: 'lsp' };
  return aliases[value] || value;
}

function hashPassword_(password) {
  var digest = Utilities.computeDigest(Utilities.DigestAlgorithm.SHA_256, String(password), Utilities.Charset.UTF_8);
  return digest.map(function (byte) { var value = byte < 0 ? byte + 256 : byte; return ('0' + value.toString(16)).slice(-2); }).join('');
}

function tokenKey_(token) { return 'session_' + String(token || ''); }

function checkLogin(email, password) {
  var normalized = String(email || '').trim().toLowerCase();
  if (!normalized || !password) return { status: 'error', message: 'Email dan password wajib diisi.' };
  var users = sheetRecords_('Users');
  var user = users.filter(function (item) { return String(item.email || '').toLowerCase() === normalized; })[0];
  if (!user || String(user.active || 'true').toLowerCase() === 'false') return { status: 'error', message: 'Akun tidak ditemukan atau tidak aktif.' };
  var expected = String(user.password_hash || user.password || '');
  var valid = expected === hashPassword_(password) || expected === String(password);
  if (!valid) return { status: 'error', message: 'Email atau password salah.' };
  var token = Utilities.getUuid();
  var profile = { email: normalized, fullName: user.fullName || user.nama || normalized, role: normalizeRole_(user.role || 'umum') };
  CacheService.getScriptCache().put(tokenKey_(token), JSON.stringify(profile), CONFIG.SESSION_SECONDS);
  return { status: 'success', message: 'Login berhasil.', user: profile, authToken: token };
}

function registerUser(data) {
  data = data || {};
  var email = String(data.email || '').trim().toLowerCase();
  var name = String(data.fullName || '').trim();
  var password = String(data.password || '');
  if (!email || !name || password.length < 6) return { status: 'error', message: 'Nama, email, dan password minimal 6 karakter wajib diisi.' };
  var existing = sheetRecords_('Users').some(function (row) { return String(row.email || '').toLowerCase() === email; });
  if (existing) return { status: 'error', message: 'Email sudah terdaftar.' };
  appendRecord_('Users', { email: email, password_hash: hashPassword_(password), fullName: name, role: 'umum', active: 'TRUE', createdAt: new Date() });
  return { status: 'success', message: 'Pendaftaran berhasil. Silakan login.' };
}

function getUserData(email) {
  var normalized = String(email || '').trim().toLowerCase();
  var user = sheetRecords_('Users').filter(function (row) { return String(row.email || '').toLowerCase() === normalized; })[0];
  if (!user) return { status: 'error', message: 'Pengguna tidak ditemukan.' };
  return { status: 'success', user: { email: normalized, fullName: user.fullName || normalized, role: normalizeRole_(user.role || 'umum') } };
}

function logoutSession(token) {
  if (token) CacheService.getScriptCache().remove(tokenKey_(token));
  return { status: 'success', message: 'Sesi ditutup.' };
}

function sendResetCode(email) {
  var normalized = String(email || '').trim().toLowerCase();
  var user = sheetRecords_('Users').filter(function (row) { return String(row.email || '').toLowerCase() === normalized; })[0];
  if (!user) return { status: 'error', message: 'Email tidak ditemukan.' };
  var code = String(Math.floor(100000 + Math.random() * 900000));
  CacheService.getScriptCache().put('otp_' + normalized, code, 600);
  MailApp.sendEmail(normalized, 'Kode Reset Password SIMPEL', 'Kode reset password Anda: ' + code + '\nBerlaku selama 10 menit.');
  return { status: 'success', message: 'Kode OTP telah dikirim ke email.' };
}

function verifyAndResetPassword(email, otp, newPassword) {
  var normalized = String(email || '').trim().toLowerCase();
  var expected = CacheService.getScriptCache().get('otp_' + normalized);
  if (!expected || String(expected) !== String(otp)) return { status: 'error', message: 'OTP tidak valid atau sudah kedaluwarsa.' };
  if (String(newPassword || '').length < 6) return { status: 'error', message: 'Password minimal 6 karakter.' };
  var users = sheetRecords_('Users');
  var user = users.filter(function (row) { return String(row.email || '').toLowerCase() === normalized; })[0];
  if (!user) return { status: 'error', message: 'Email tidak ditemukan.' };
  updateRecord_('Users', user._rowIndex, { password_hash: hashPassword_(newPassword) });
  CacheService.getScriptCache().remove('otp_' + normalized);
  return { status: 'success', message: 'Password berhasil diubah.' };
}

function getModuleRecords(email, moduleName, year, token) {
  var sheetName = MODULE_TO_SHEET[moduleName] || moduleName;
  var records = sheetRecords_(sheetName, year);
  records.forEach(function (row) {
    var stage = value_(row, ['STATUS ALUR', 'STATUS', 'Status']) || '';
    var participants = number_(value_(row, ['JUMLAH PESERTA PELATIHAN', 'Jumlah Peserta Pelatihan']));
    if (!stage && !participants) stage = 'MENUNGGU_PESERTA';
    row._stage = stage;
    row._stageText = stageText_(stage, participants);
    row._badge = badge_(stage);
  });
  return { status: 'success', records: records };
}

function stageText_(stage, participants) {
  var map = { MENUNGGU_PESERTA: 'Menunggu Input Peserta (Pemberdayaan)', SIAP_DIMULAI: 'Peserta Lengkap (Menunggu Penyelenggara)', BERJALAN: 'Kelas Berjalan', SELESAI: 'Selesai & Kelulusan Terdata' };
  if (!stage) return participants ? 'Peserta Lengkap' : 'Draft';
  return map[stage] || stage;
}

function badge_(stage) {
  var map = { MENUNGGU_PESERTA: 'bg-purple-100 text-purple-800 border-purple-300', SIAP_DIMULAI: 'bg-amber-100 text-amber-800 border-amber-300', BERJALAN: 'bg-blue-100 text-blue-800 border-blue-300', SELESAI: 'bg-emerald-100 text-emerald-800 border-emerald-300' };
  return map[stage] || 'bg-slate-100 text-slate-700 border-slate-200';
}

function saveInputRecord(email, moduleName, year, values, token) {
  var sheetName = MODULE_TO_SHEET[moduleName] || moduleName;
  values = values || {};
  values.TAHUN = year || CONFIG.ACTIVE_YEAR;
  return appendRecord_(sheetName, values);
}

function saveProgramPenyelenggara(email, year, data, token) {
  data = data || {};
  data.TAHUN = year || CONFIG.ACTIVE_YEAR;
  data['STATUS ALUR'] = 'MENUNGGU_PESERTA';
  if (!data.NO) data.NO = sheetRecords_('program_pelatihan').length + 1;
  return appendRecord_('program_pelatihan', data);
}

function updatePesertaPemberdayaan(email, year, rowIndex, data, token) {
  data = data || {};
  data['STATUS ALUR'] = 'SIAP_DIMULAI';
  data.TAHUN = year || CONFIG.ACTIVE_YEAR;
  return updateRecord_('program_pelatihan', rowIndex, data);
}

function startKelasPenyelenggara(email, year, rowIndex, data, token) {
  data = data || {};
  data.TAHUN = year || CONFIG.ACTIVE_YEAR;
  data['STATUS ALUR'] = data.LULUS !== '' && data.LULUS !== undefined ? 'SELESAI' : 'BERJALAN';
  return updateRecord_('program_pelatihan', rowIndex, data);
}

function getPelatihanStats(year) {
  var records = sheetRecords_('program_pelatihan', year);
  return { status: 'success', totalPesertaGabungan: sumField_(records, ['JUMLAH PESERTA PELATIHAN', 'Jumlah Peserta Pelatihan']) };
}

function getSertifikasiStats(year) {
  var records = sheetRecords_('sertifikasi', year);
  return { status: 'success', totalPeserta: records.length };
}

function getPenempatanStats(year) {
  var records = sheetRecords_('penempatan', year);
  return { status: 'success', totalDitempatkan: sumField_(records, ['Total Penempatan', 'Ditempatkan / Bekerja', 'Jumlah Alumni Yang Ditempatkan']) };
}

function getTargetRealisasiPelatihan(year) {
  var records = sheetRecords_('target_realisasi', year);
  return { status: 'success', rows: records.map(function (row) { return { kejuruan: value_(row, ['JENIS PELATIHAN', 'Jenis Pelatihan', 'KEJURUAN']), target: number_(value_(row, ['TARGET', 'Target'])), realisasi: number_(value_(row, ['REALISASI', 'Realisasi'])) }; }) };
}

function getJenisPelatihanStats(year) {
  var records = sheetRecords_('jenis_pelatihan', year);
  return { status: 'success', rows: records.map(function (row) { return { jenis: value_(row, ['PROGRAM PELATIHAN', 'Program Pelatihan', 'JENIS PELATIHAN']), target: number_(value_(row, ['TARGET', 'Target'])), realisasi: number_(value_(row, ['REALISASI', 'Realisasi'])) }; }) };
}

function getRealisasiAnggaranDashboard(year) {
  var records = sheetRecords_('realisasi_anggaran', year);
  return { status: 'success', rows: records.map(function (row) { var percentage = number_(value_(row, ['PERSENTASE', 'Persentase'])); return { uraian: value_(row, ['URAIAN', 'Uraian', 'Realisasi Anggaran']), target: value_(row, ['TARGET', 'Target']), persen100: percentage, persenText: percentage + '%' }; }) };
}

function getKegiatanPelatihanStats(year) {
  var records = sheetRecords_('jenis_pelatihan', year);
  return { status: 'success', rows: records.map(function (row) { return { kegiatan: value_(row, ['PROGRAM PELATIHAN', 'Program Pelatihan']), target: number_(value_(row, ['TARGET', 'Target'])), realisasi: number_(value_(row, ['REALISASI', 'Realisasi'])) }; }) };
}

function getProduktivitasStats(year) {
  var records = sheetRecords_('produktivitas', year);
  return {
    status: 'success',
    totalPeserta: sumField_(records, ['Jumlah', 'JUMLAH', 'Peserta']),
    lakiLaki: sumField_(records, ['Laki-Laki', 'LAKI-LAKI', 'Laki laki']),
    perempuan: sumField_(records, ['Perempuan', 'PEREMPUAN'])
  };
}

function getBimbinganKonsultasi(year) {
  var records = sheetRecords_('produktivitas', year);
  return {
    status: 'success',
    data: records.map(function (row, index) {
      return {
        no: value_(row, ['No', 'NO']) || index + 1,
        nama: value_(row, ['Nama Perusahaan', 'Nama', 'Peserta']) || '-',
        alamat: value_(row, ['Alamat Perusahaan', 'Alamat']) || '-'
      };
    })
  };
}

function getPelatihanUptdStats(year) {
  var sheetNames = ['uptd_kolaka', 'uptd_kolaka_utara', 'uptd_konawe_selatan', 'uptd_konawe_utara', 'uptd_buton'];
  var daerahNames = ['Kolaka', 'Kolaka Utara', 'Konawe Selatan', 'Konawe Utara', 'Buton'];
  var allByArea = sheetNames.map(function (sheetName, index) {
    return { name: daerahNames[index], records: sheetRecords_(sheetName, year) };
  });
  var totalRecords = [];
  allByArea.forEach(function (area) { totalRecords = totalRecords.concat(area.records); });
  var ageKeys = ['U 17-24', 'U 25-28', 'U 29-34', 'U 35-40', 'U 41-dst'];
  var ageLabels = ['17-24', '25-28', '29-34', '35-40', '41-dst'];
  var educationKeys = ['S1/D4', 'D3', 'SMA / SMK', 'SMP', 'SD'];
  var educationLabels = ['Sarjana', 'D3', 'SMA/SMK', 'SMP', 'SD'];
  var byKejuruan = {};
  var byArea = {};
  totalRecords.forEach(function (row) {
    var kejuruan = value_(row, ['KEJURUAN', 'Kejuruan']) || 'Belum diisi';
    byKejuruan[kejuruan] = (byKejuruan[kejuruan] || 0) + number_(value_(row, ['JUMLAH PESERTA PELATIHAN', 'Jumlah Peserta Pelatihan']));
  });
  allByArea.forEach(function (area) {
    byArea[area.name] = sumField_(area.records, ['JUMLAH PESERTA PELATIHAN', 'Jumlah Peserta Pelatihan']);
  });
  var educationValues = educationKeys.map(function (key) { return sumField_(totalRecords, [key]); });
  var ageTotals = ageKeys.map(function (key) { return sumField_(totalRecords, [key]); });
  var educationMatrix = educationKeys.map(function (key) { return allByArea.map(function (area) { return sumField_(area.records, [key]); }); });
  var ageMatrix = allByArea.map(function (area) { return ageKeys.map(function (key) { return sumField_(area.records, [key]); }); });
  return {
    status: 'success',
    totalPeserta: sumField_(totalRecords, ['JUMLAH PESERTA PELATIHAN', 'Jumlah Peserta Pelatihan']),
    lakiLaki: sumField_(totalRecords, ['LAKI-LAKI', 'Laki-Laki']),
    perempuan: sumField_(totalRecords, ['PEREMPUAN', 'Perempuan']),
    disabilitas: sumField_(totalRecords, ['DISABILITAS', 'Disabilitas']),
    uptdLabels: daerahNames,
    uptdValues: daerahNames.map(function (name) { return byArea[name] || 0; }),
    kejuruanLabels: Object.keys(byKejuruan),
    kejuruanValues: Object.keys(byKejuruan).map(function (key) { return byKejuruan[key]; }),
    kejuruanDetailDaerahLabels: daerahNames,
    kejuruanDetailMatrix: Object.keys(byKejuruan).map(function (kejuruan) { return allByArea.map(function (area) { return sumField_(area.records.filter(function (row) { return value_(row, ['KEJURUAN', 'Kejuruan']) === kejuruan; }), ['JUMLAH PESERTA PELATIHAN', 'Jumlah Peserta Pelatihan']); }); }),
    pendidikanLabels: educationLabels,
    pendidikanValues: educationValues,
    pendidikanDaerahLabels: daerahNames,
    pendidikanMatrix: educationMatrix,
    usiaLabels: ageLabels,
    usiaTotals: ageTotals,
    usiaDaerahLabels: daerahNames,
    usiaMatrix: ageMatrix
  };
}

function getProgramList(year) {
  var records = sheetRecords_('program_pelatihan', year);
  var programs = records.map(function (r) {
    var nama = value_(r, ['PROGRAM PELATIHAN', 'Program Pelatihan', 'nama_program']);
    var batch = value_(r, ['NO', 'Batch']) ? 'Batch ' + value_(r, ['NO', 'Batch']) : '';
    var peserta = number_(value_(r, ['JUMLAH PESERTA PELATIHAN', 'Jumlah Peserta Pelatihan', 'TARGET PESERTA'])) || 16;
    var kejuruan = value_(r, ['KEJURUAN', 'Kejuruan']);
    var label = nama + (batch ? ' - ' + batch : '');
    return { name: label, program: nama, batch: batch, peserta: peserta, kejuruan: kejuruan };
  });
  return { status: 'success', programs: programs };
}

function getPengadaan(year) {
  return { status: 'success', records: sheetRecords_('pengadaan', year) };
}

function savePengadaan(email, year, data, token) {
  data = data || {};
  data.ID = data.ID || Utilities.getUuid();
  data.TAHUN = year || CONFIG.ACTIVE_YEAR;
  data.STATUS = data.STATUS || 'Menunggu verifikasi';
  data.createdAt = new Date();
  return appendRecord_('pengadaan', data);
}

function updatePengadaan(email, year, rowIndex, data, token) {
  data = data || {};
  data.TAHUN = year || CONFIG.ACTIVE_YEAR;
  data.updatedAt = new Date();
  return updateRecord_('pengadaan', rowIndex, data);
}

function deletePengadaan(email, year, rowIndex, token) {
  return deleteRecord_('pengadaan', rowIndex);
}

function getPembayaran(year) {
  return { status: 'success', records: sheetRecords_('pembayaran', year) };
}

function savePembayaran(email, year, data, token) {
  data = data || {};
  data.ID = data.ID || Utilities.getUuid();
  data.TAHUN = year || CONFIG.ACTIVE_YEAR;
  data.updatedAt = new Date();
  return appendRecord_('pembayaran', data);
}

function updatePembayaran(email, year, rowIndex, data, token) {
  data = data || {};
  data.TAHUN = year || CONFIG.ACTIVE_YEAR;
  data.updatedAt = new Date();
  return updateRecord_('pembayaran', rowIndex, data);
}

function updateStatusPembayaran(email, year, rowIndex, status, catatan, token) {
  return updateRecord_('pembayaran', rowIndex, { 'STATUS PEMBAYARAN': status, CATATAN: catatan || '', updatedAt: new Date(), TAHUN: year || CONFIG.ACTIVE_YEAR });
}

function deletePembayaran(email, year, rowIndex, token) {
  return deleteRecord_('pembayaran', rowIndex);
}

function getPimpinanDashboardData(year) {
  var programs = sheetRecords_('program_pelatihan', year);
  var payments = sheetRecords_('pembayaran', year);
  var procurement = sheetRecords_('pengadaan', year);
  var batches = programs.map(function (row) {
    var program = value_(row, ['PROGRAM PELATIHAN', 'Program Pelatihan']);
    var stage = value_(row, ['STATUS ALUR', 'STATUS']);
    var total = number_(value_(row, ['JUMLAH PESERTA PELATIHAN', 'Jumlah Peserta Pelatihan']));
    var payment = payments.filter(function (item) { return String(value_(item, ['PROGRAM / BATCH', 'PROGRAM PELATIHAN'])).toLowerCase() === String(program).toLowerCase(); })[0];
    var progress = stage === 'SELESAI' ? 100 : stage === 'BERJALAN' ? 70 : stage === 'SIAP_DIMULAI' ? 45 : 20;
    return { program: program, batch: value_(row, ['NO', 'Batch']) || '-', mulai: value_(row, ['TGL MULAI PELATIHAN', 'TGL MASUK']), peserta: total, progress: progress, payment: value_(payment || {}, ['STATUS PEMBAYARAN', 'STATUS']) || 'Belum diajukan', kebutuhan: procurement.filter(function (item) { return String(value_(item, ['PROGRAM / BATCH'])).toLowerCase() === String(program).toLowerCase(); }).map(function (item) { return value_(item, ['NAMA ALAT / BAHAN']); }).join(', ') || 'Belum diinput' };
  });
  var countByStatus = function (status) { return procurement.filter(function (item) { return String(value_(item, ['STATUS'])).toLowerCase() === status.toLowerCase(); }).length; };
  return { status: 'success', batches: batches, procurement: [{ label: 'Sudah disetujui Pokja', value: countByStatus('Disetujui Pokja'), tone: 'bg-emerald-100 text-emerald-800' }, { label: 'Menunggu verifikasi', value: countByStatus('Menunggu verifikasi'), tone: 'bg-amber-100 text-amber-800' }, { label: 'Belum dibuat', value: programs.length - procurement.length, tone: 'bg-rose-100 text-rose-800' }] };
}

function setupSheets() {
  Object.keys(HEADERS).forEach(function (name) { ensureHeaders_(name); });
  return { status: 'success', message: 'Sheet SIMPEL berhasil disiapkan.' };
}
