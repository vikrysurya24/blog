<?php
/*
language : Indonesia
*/
return [
    'title' => [
        'index' => 'Label',
        'create' => 'Tambah label',
        'edit' => 'Ubah label',
    ],
    'form_control' => [
        'input' => [
            'title' => [
                'label' => 'Judul',
                'placeholder' => 'Masukan judul',
                'attribute' => 'judul'
            ],
            'slug' => [
                'label' => 'Slug',
                'placeholder' => 'Otomatis dibuatkan',
                'attribute' => 'slug'
            ],
            'search' => [
                'label' => 'Pencarian',
                'placeholder' => 'Cari label',
                'attribute' => 'pencarian'
            ]
        ],
    ],
    'label' => [
        'no_data' => [
            'fetch' => "Data label belum ada",
            'search' => "Label :keyword tidak ditemukan",
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
            'title' => "Tambah label",
            'message' => [
                'success' => "Label berhasil disimpan.",
                'error' => "Terjadi kesalahan saat menyimpan label. :error"
            ]
        ],
        'update' => [
            'title' => 'Ubah label',
            'message' => [
                'success' => "Label berhasil diperbaharui.",
                'error' => "Terjadi kesalahan saat perbarui label. :error"
            ]
        ],
        'delete' => [
            'title' => 'Hapus label',
            'message' => [
                'confirm' => "Yakin akan menghapus label :title ?",
                'success' => "Label berhasil dihapus",
                'error' => "Terjadi kesalahan saat menghapus label. :error"
            ]
        ],
    ]
];
