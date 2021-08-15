<?php
/*
language : Indonesia
*/
return [
    'title' => [
        'index' => 'Posting',
        'create' => 'Tambah posting',
        'edit' => 'Ubah posting',
        'detail' => 'Detail posting',
    ],
    'label' => [
        'no_data' => [
            'fetch' => "Data posting belum ada",
            'search' => "Judul posting :keyword tidak ditemukan",
        ]
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
            'thumbnail' => [
                'label' => 'Thumbnail',
                'placeholder' => 'Telusuri thumbnail',
                'attribute' => 'thumbnail'
            ],
            'search' => [
                'label' => 'Pencarian',
                'placeholder' => 'Cari posting',
                'attribute' => 'pencarian'
            ]
        ],
        'select' => [
            'tag' => [
                'label' => 'Label',
                'placeholder' => 'Masukan label',
                'attribute' => 'label',
                'option' => [
                    'publish' => 'Terbit',
                    'draft' => 'Draf'
                ]
            ],
            'status' => [
                'label' => 'Status',
                'placeholder' => 'Pilih status',
                'attribute' => 'status',
                'option' => [
                    'draft' => 'Draf',
                    'publish' => 'Terbit',
                ]
            ],
            'category' => [
                'label' => 'Kategori',
                'placeholder' => 'Pilih kategori',
                'attribute' => 'kategori',
                'option' => [
                    'draft' => 'Draf',
                    'publish' => 'Terbit',
                ]
            ],
        ],
        'textarea' => [
            'description' => [
                'label' => 'Deskripsi',
                'placeholder' => 'Masukan deskripsi',
                'attribute' => 'deskripsi'
            ],
            'content' => [
                'label' => 'Konten',
                'placeholder' => 'Masukan konten',
                'attribute' => 'konten'
            ],
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
        'browse' => [
            'value' => 'Telusuri'
        ],
        'back' => [
            'value' => 'Kembali'
        ],
        'apply' => [
            'value' => 'Terapkan'
        ]
    ],
    'alert' => [
        'create' => [
            'title' => "Tambah posting",
            'message' => [
                'success' => "Posting berhasil disimpan.",
                'error' => "Terjadi kesalahan saat menyimpan posting. :error"
            ]
        ],
        'update' => [
            'title' => 'Ubah posting',
            'message' => [
                'success' => "Posting berhasil diperbaharui.",
                'error' => "Terjadi kesalahan saat perbarui posting. :error"
            ]
        ],
        'delete' => [
            'title' => 'Hapus posting',
            'message' => [
                'confirm' => "Yakin akan menghapus posting :title ?",
                'success' => "Posting berhasil dihapus",
                'error' => "Terjadi kesalahan saat menghapus posting. :error"
            ]
        ],
    ]
];
