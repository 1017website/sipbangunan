<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@sipbangunan.com'],
            [
                'name' => 'Admin SIP Bangunan',
                'password' => Hash::make('password'),
            ]
        );

        // Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'SIP Bangunan', 'label' => 'Nama Toko', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Supplier Bahan Bangunan Terlengkap', 'label' => 'Tagline', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Supplier bahan bangunan lengkap sejak 2014. Kami melayani kontraktor, developer, hingga pemilik rumah dengan produk berstandar SNI dan harga yang bersaing.', 'label' => 'Deskripsi', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'wa_number', 'value' => '6281234567890', 'label' => 'Nomor WhatsApp', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'address', 'value' => 'Jl. Contoh No. 123, Jakarta Timur, DKI Jakarta 13000', 'label' => 'Alamat', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'phone', 'value' => '+62 812-3456-7890', 'label' => 'Telepon', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'info@sipbangunan.com', 'label' => 'Email', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'hours', 'value' => 'Senin – Sabtu: 08.00 – 17.00 WIB', 'label' => 'Jam Operasional', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'tokped_url', 'value' => 'https://www.tokopedia.com/sipbangunan', 'label' => 'URL Tokopedia', 'type' => 'text', 'group' => 'marketplace'],
            ['key' => 'shopee_url', 'value' => 'https://shopee.co.id/sipbangunan', 'label' => 'URL Shopee', 'type' => 'text', 'group' => 'marketplace'],
            ['key' => 'tiktok_url', 'value' => 'https://www.tiktok.com/@sipbangunan', 'label' => 'URL TikTok Shop', 'type' => 'text', 'group' => 'marketplace'],
            ['key' => 'maps_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.54508529228!2d106.75287999999999!3d-6.229728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%20Timur!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid', 'label' => 'Google Maps Embed URL', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'hero_title', 'value' => 'Semua Material Bangunan yang Anda Butuhkan', 'label' => 'Judul Hero', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_subtitle', 'value' => 'Supplier Terpercaya Sejak 2014', 'label' => 'Subtitle Hero', 'type' => 'text', 'group' => 'hero'],
            ['key' => 'hero_desc', 'value' => 'Satu tempat untuk semua kebutuhan material — semen, besi, baja, galvalum, atap, pipa, triplek, cat & lebih banyak. Kualitas SNI, harga bersaing, pengiriman cepat.', 'label' => 'Deskripsi Hero', 'type' => 'textarea', 'group' => 'hero'],
            ['key' => 'stat_categories', 'value' => '8+', 'label' => 'Stat Kategori', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_products', 'value' => '100+', 'label' => 'Stat Produk', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_years', 'value' => '10+', 'label' => 'Stat Tahun', 'type' => 'text', 'group' => 'stats'],
            ['key' => 'stat_customers', 'value' => '1K+', 'label' => 'Stat Pelanggan', 'type' => 'text', 'group' => 'stats'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }

        // Categories
        $categories = [
            ['name' => 'Semen', 'icon' => '🏗️', 'description' => 'Semen OPC, PCC, dan berbagai jenis semen konstruksi', 'sort_order' => 1],
            ['name' => 'Besi & Baja', 'icon' => '⚙️', 'description' => 'Besi beton, wiremesh, baja profil, hollow galvanis', 'sort_order' => 2],
            ['name' => 'Galvalum & Reng', 'icon' => '🔩', 'description' => 'Kanal C galvalum, reng galvalum, baja ringan', 'sort_order' => 3],
            ['name' => 'Atap', 'icon' => '🏠', 'description' => 'Atap UPVC, atap metal, berbagai jenis penutup atap', 'sort_order' => 4],
            ['name' => 'Pipa & Sanitasi', 'icon' => '🚿', 'description' => 'Pipa PVC, pipa galvanis, fitting, sanitasi', 'sort_order' => 5],
            ['name' => 'Triplek & Kayu', 'icon' => '🪵', 'description' => 'Triplek, plywood, kayu olahan, MDF', 'sort_order' => 6],
            ['name' => 'Bata & Mortar', 'icon' => '🧱', 'description' => 'Bata ringan Hebel, mortar siap pakai, semen instan', 'sort_order' => 7],
            ['name' => 'Cat & Finishing', 'icon' => '🎨', 'description' => 'Cat Nippon Paint, Avian, dan berbagai merk cat', 'sort_order' => 8],
        ];

        foreach ($categories as $cat) {
            $category = Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                array_merge($cat, ['slug' => Str::slug($cat['name']), 'is_active' => true])
            );

            // Sample products per category
            $products = $this->getProductsForCategory($cat['name'], $category->id);
            foreach ($products as $prod) {
                Product::updateOrCreate(
                    ['slug' => Str::slug($prod['name'])],
                    $prod
                );
            }

            // Update product count
            $category->product_count = $category->products()->count();
            $category->save();
        }
    }

    private function getProductsForCategory(string $catName, int $categoryId): array
    {
        $waNum = '6281234567890';
        $maps = [
            'Semen' => [
                ['name' => 'Semen Portland OPC 40kg', 'icon' => '🏗️', 'spec' => 'Zak 40kg', 'description' => 'Semen Portland Type OPC standar SNI, cocok untuk semua konstruksi umum.', 'specs' => [['Berat', '40 kg/zak'], ['Tipe', 'OPC (Ordinary Portland Cement)'], ['Standar', 'SNI 2049:2015'], ['Kuat Tekan', '≥ 250 kg/cm²'], ['Setting Time', '< 90 menit']]],
                ['name' => 'Semen PCC 40kg', 'icon' => '🏗️', 'spec' => 'Zak 40kg', 'description' => 'Semen Portland Composite Cement (PCC), lebih hemat dan ramah lingkungan.', 'specs' => [['Berat', '40 kg/zak'], ['Tipe', 'PCC (Portland Composite Cement)'], ['Standar', 'SNI 7064:2014'], ['Keunggulan', 'Lebih workable']]],
                ['name' => 'Semen Putih', 'icon' => '⬜', 'spec' => 'Zak 25kg', 'description' => 'Semen putih untuk nat keramik, plesteran dekoratif, dan finishing.', 'specs' => [['Berat', '25 kg/zak'], ['Warna', 'Putih'], ['Penggunaan', 'Nat, finishing, dekorasi']]],
            ],
            'Besi & Baja' => [
                ['name' => 'Besi Beton Ulir D10', 'icon' => '⚙️', 'spec' => 'Batang 12m', 'description' => 'Besi beton ulir diameter 10mm, panjang 12 meter. SNI.', 'specs' => [['Diameter', '10 mm'], ['Panjang', '12 meter'], ['Tipe', 'Ulir (deformed)'], ['Standar', 'SNI 2052:2017']]],
                ['name' => 'Besi Beton Polos D8', 'icon' => '⚙️', 'spec' => 'Batang 12m', 'description' => 'Besi beton polos diameter 8mm untuk konstruksi ringan.', 'specs' => [['Diameter', '8 mm'], ['Panjang', '12 meter'], ['Tipe', 'Polos (plain)']]],
                ['name' => 'Wiremesh M6 2.1x5.4m', 'icon' => '🔲', 'spec' => 'Lembar 2.1×5.4m', 'description' => 'Wiremesh besi tulangan lembaran untuk lantai dan beton.', 'specs' => [['Diameter kawat', '6 mm'], ['Ukuran lembar', '2.1 × 5.4 m'], ['Jarak kawat', '150 × 150 mm']]],
                ['name' => 'Hollow Galvanis 4x4cm', 'icon' => '📐', 'spec' => 'Batang 6m', 'description' => 'Hollow galvanis 40x40mm untuk rangka partisi dan furnitur.', 'specs' => [['Ukuran', '40 × 40 mm'], ['Panjang', '6 meter'], ['Ketebalan', '1.2 mm'], ['Finishing', 'Galvanis']]],
            ],
            'Galvalum & Reng' => [
                ['name' => 'Kanal C 75x45x0.75mm', 'icon' => '🔩', 'spec' => 'Batang 6m', 'description' => 'Kanal C galvalum untuk rangka atap baja ringan.', 'specs' => [['Ukuran', '75 × 45 × 0.75 mm'], ['Panjang', '6 meter'], ['Material', 'Galvalum G550']]],
                ['name' => 'Reng Galvalum 30x45mm', 'icon' => '🔩', 'spec' => 'Batang 6m', 'description' => 'Reng galvalum untuk dudukan genteng/atap.', 'specs' => [['Ukuran', '30 × 45 mm'], ['Panjang', '6 meter'], ['Material', 'Galvalum']]],
            ],
            'Atap' => [
                ['name' => 'Atap UPVC Trimdek', 'icon' => '🏠', 'spec' => 'Lembar 3m', 'description' => 'Atap UPVC anti panas, anti bocor, tahan lama. Berbagai ukuran tersedia.', 'specs' => [['Material', 'UPVC'], ['Panjang', '3 meter'], ['Lebar efektif', '760 mm'], ['Keunggulan', 'Anti panas, anti bocor']]],
                ['name' => 'Atap Metal Pasir', 'icon' => '🏠', 'spec' => 'Lembar 6m', 'description' => 'Atap metal stone coated (pasir) tahan karat dan tahan cuaca.', 'specs' => [['Material', 'Metal stone coated'], ['Panjang', '6 meter'], ['Garansi', '30 tahun']]],
            ],
            'Pipa & Sanitasi' => [
                ['name' => 'Pipa PVC AW 4 inch', 'icon' => '🚿', 'spec' => 'Batang 4m', 'description' => 'Pipa PVC tipe AW (kelas berat) untuk instalasi air bersih.', 'specs' => [['Diameter', '4 inch (110mm)'], ['Panjang', '4 meter'], ['Tipe', 'AW (Heavy duty)'], ['Standar', 'SNI 0162:2011']]],
                ['name' => 'Pipa PVC D 3 inch', 'icon' => '🚿', 'spec' => 'Batang 4m', 'description' => 'Pipa PVC tipe D untuk saluran pembuangan dan drainase.', 'specs' => [['Diameter', '3 inch (75mm)'], ['Panjang', '4 meter'], ['Tipe', 'D (Medium duty)']]],
            ],
            'Triplek & Kayu' => [
                ['name' => 'Triplek 9mm 122x244cm', 'icon' => '🪵', 'spec' => 'Lembar 122×244cm', 'description' => 'Triplek kayu lapis 9mm untuk bekisting, partisi, dan furniture.', 'specs' => [['Ketebalan', '9 mm'], ['Ukuran', '122 × 244 cm'], ['Material', 'Kayu lapis'], ['Lapisan', '7 ply']]],
                ['name' => 'Plywood 18mm 122x244cm', 'icon' => '🪵', 'spec' => 'Lembar 122×244cm', 'description' => 'Plywood tebal 18mm untuk alas lantai dan konstruksi.', 'specs' => [['Ketebalan', '18 mm'], ['Ukuran', '122 × 244 cm']]],
            ],
            'Bata & Mortar' => [
                ['name' => 'Bata Ringan Hebel 7.5x20x60cm', 'icon' => '🧱', 'spec' => 'Pcs', 'description' => 'Bata ringan AAC (Autoclaved Aerated Concrete) untuk dinding.', 'specs' => [['Ukuran', '7.5 × 20 × 60 cm'], ['Density', '550-650 kg/m³'], ['Standar', 'SNI 03-3449-2002']]],
                ['name' => 'Mortar Semen Instant 40kg', 'icon' => '🧱', 'spec' => 'Zak 40kg', 'description' => 'Mortar semen instant siap pakai untuk pasangan bata dan plester.', 'specs' => [['Berat', '40 kg/zak'], ['Penggunaan', 'Pasangan bata, plester'], ['Keunggulan', 'Siap pakai, hemat air']]],
            ],
            'Cat & Finishing' => [
                ['name' => 'Cat Nippon Paint 2.5L', 'icon' => '🎨', 'spec' => 'Kaleng 2.5L', 'description' => 'Cat dinding interior Nippon Paint Vinilex. Berbagai warna tersedia.', 'specs' => [['Volume', '2.5 Liter'], ['Merek', 'Nippon Paint'], ['Tipe', 'Vinilex / Interior'], ['Coverage', '±12 m²/L']]],
                ['name' => 'Cat Avian 25kg', 'icon' => '🎨', 'spec' => 'Ember 25kg', 'description' => 'Cat tembok Avian untuk exterior, tahan cuaca dan hujan.', 'specs' => [['Berat', '25 kg'], ['Merek', 'Avian'], ['Tipe', 'Exterior'], ['Keunggulan', 'Tahan cuaca, anti jamur']]],
            ],
        ];

        $result = [];
        $products = $maps[$catName] ?? [];
        foreach ($products as $i => $p) {
            $p['category_id'] = $categoryId;
            $p['slug'] = Str::slug($p['name']);
            $p['is_active'] = true;
            $p['sort_order'] = $i + 1;
            $p['tokped_url'] = 'https://www.tokopedia.com/sipbangunan';
            $p['shopee_url'] = 'https://shopee.co.id/sipbangunan';
            $p['tiktok_url'] = 'https://www.tiktok.com/@sipbangunan';
            $p['wa_text'] = 'Halo SIP Bangunan, saya ingin bertanya tentang ' . $p['name'];
            if (isset($p['specs'])) {
                $p['specs'] = json_encode($p['specs']);
            }
            $result[] = $p;
        }
        return $result;
    }
}
