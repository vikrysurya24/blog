<?php
/*
language : Indonesia
*/
return [
    'title' => [
        'index' => 'Pengguna',
        'create' => 'Tambah Pengguna',
        'edit' => 'Ubah Pengguna',
    ],
    'form_control' => [
        'input' => [
            'name' => [
                'label' => 'Nama',
                'placeholder' => 'Masukan nama',
                'attribute' => 'nama'
            ],
            'email' => [
                'label' => 'Email',
                'placeholder' => 'Masukan email',
                'attribute' => 'email'
            ],
            'password' => [
                'label' => 'Kata Sandi',
                'placeholder' => 'Masukan kata sandi',
                'attribute' => 'kata sandi'
            ],
            'password_confirmation' => [
                'label' => 'Konfirmasi Kata Sandi',
                'placeholder' => 'Ketik ulang kata sandi',
                'attribute' => 'konfirmasi kata sandi'
            ],
            'search' => [
                'label' => 'Cari',
                'placeholder' => 'Cari pengguna',
                'attribute' => 'cari'
            ]
        ],
        'select' => [
            'role' => [
                'label' => 'Wewenang',
                'placeholder' => 'Pilih wewenang',
                'attribute' => 'wewenang'
            ]
        ]
    ],
    'label' => [
        'name' => 'Nama',
        'email' => 'Email',
        'role' => 'Wewenang',
        'no_data' => [
            'fetch' => "Data user belum ada",
            'search' => "User :keyword tidak ditemukan",
        ],
        'show_password' => [
            'label' => 'Lihat Kata Sandi'
        ]
    ],
    'button' => [
        'create' => [
            'value' => 'Tambah'
        ],
        'save' => [
            'value' => 'Simpan'
        ],
        'edit' => [
            'value' => 'Ubah'
        ],
        'delete' => [
            'value' => 'Hapus'
        ],
        'cancel' => [
            'value' => 'Batal'
        ],
        'back' => [
            'value' => 'Kembali'
        ],
    ],
    'alert' => [
        'create' => [
            'title' => "Tambah Pengguna",
            'message' => [
                'success' => "Pengguna berhasil disimpan.",
                'error' => "Terjadi kesalahan saat menyimpan pengguna. :error"
            ]
        ],
        'update' => [
            'title' => 'Ubah pengguna',
            'message' => [
                'success' => "Pengguna berhasil diperbaharui.",
                'error' => "Terjadi kesalahan saat perbarui pengguna. :error"
            ]
        ],
        'delete' => [
            'title' => 'Hapus pengguna',
            'message' => [
                'confirm' => "Yakin akan menghapus pengguna :name ?",
                'success' => "Pengguna berhasil dihapus",
                'error' => "Terjadi kesalahan saat menghapus pengguna. :error"
            ]
        ],
    ]
];
