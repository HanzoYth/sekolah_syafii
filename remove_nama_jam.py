import re

filepath = 'resources/views/modul/siakad/admin/kelolaReferensi.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Remove table header and column
content = re.sub(r'<th>Nama Jam</th>\s*', '', content)
content = re.sub(r'<td><strong>\{\{\s*\$j->nama_jam\s*\}\}</strong></td>\s*', '', content)
content = content.replace('colspan="5"', 'colspan="4"')

# Remove inputs from modals
# Add Jam Modal
content = re.sub(r'<div class=\"form-group\">\s*<label>Nama Jam.*?<\/label>\s*<input type=\"text\" name=\"nama_jam\".*?>\s*<\/div>', '', content, flags=re.DOTALL)
# Edit Jam Modal
content = re.sub(r'<div class=\"form-group\">\s*<label>Nama Jam<\/label>\s*<input type=\"text\" name=\"nama_jam\" id=\"ejNama\".*?>\s*<\/div>', '', content, flags=re.DOTALL)

# Modify JS function openEditJam(id, nama, mulai, selesai) -> openEditJam(id, mulai, selesai)
content = re.sub(r'openEditJam\(\{\{\s*\$j->id\s*\}\},\s*\'\{\{\s*\$j->nama_jam\s*\}\}\',\s*', 'openEditJam({{ $j->id }}, ', content)
content = re.sub(r'function openEditJam\(id, nama, mulai, selesai\) \{.*?\n\s*document\.getElementById\(\'ejNama\'\)\.value = nama;.*?\n', 
                 'function openEditJam(id, mulai, selesai) {\n            document.getElementById(\'editJamForm\').action = "/sk/update-jam-pelajaran/" + id;\n', content, flags=re.DOTALL)

# Modify JS function openDeleteJam(id, nama) -> openDeleteJam(id, mulai, selesai)
content = re.sub(r'openDeleteJam\(\{\{\s*\$j->id\s*\}\},\s*\'\{\{\s*\$j->nama_jam\s*\}\}\'\)', 'openDeleteJam({{ $j->id }}, \'{{ $j->jam_mulai }} - {{ $j->jam_selesai }}\')', content)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

