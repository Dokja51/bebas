<?= $this->extend('part/index'); ?>
<?= $this->section('content'); ?>
        <!-- ===== Main Content Start ===== -->
        <main>
          <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <!-- Breadcrumb Start -->
            <div x-data="{ pageName: `Basic Tables`}">
              <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
  <h2
    class="text-xl font-semibold text-gray-800 dark:text-white/90"
    x-text="pageName"
  ></h2>

  <nav>
    <ol class="flex items-center gap-1.5">
      <li>
        <a
          class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
          href="index.html"
        >
          Home
          <svg
            class="stroke-current"
            width="17"
            height="16"
            viewBox="0 0 17 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366"
              stroke=""
              stroke-width="1.2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </a>
      </li>
      <li
        class="text-sm text-gray-800 dark:text-white/90"
        x-text="pageName"
      ></li>
    </ol>
  </nav>
</div>
</div>
            <!-- Breadcrumb End -->

            <div class="space-y-5 sm:space-y-6">
              <div
                class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
              >
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                  <h3
                    class="text-base font-medium text-gray-800 dark:text-white/90"
                  >
                    Basic Table 1
                  </h3>
                </div>
                <div
                  class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6"
                >
                  <!-- ====== Table Six Start -->
                  <div
  class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
>
  <div class="max-w-full overflow-x-auto">
    <table class="min-w-full">
      <!-- table header start -->
      <thead>
        <tr class="border-b border-gray-100 dark:border-gray-800">
          <th class="px-5 py-3 sm:px-6">
  <p class="font-medium text-gray-500 text-theme-xs">Nama Siswa</p>
</th>

<th class="px-5 py-3 sm:px-6">
  <p class="font-medium text-gray-500 text-theme-xs">Judul Buku</p>
</th>

<th class="px-5 py-3 sm:px-6">
  <p class="font-medium text-gray-500 text-theme-xs">Kategori</p>
</th>

<th class="px-5 py-3 sm:px-6">
  <p class="font-medium text-gray-500 text-theme-xs">Tanggal Pinjam</p>
</th>

<th class="px-5 py-3 sm:px-6">
  <p class="font-medium text-gray-500 text-theme-xs">Status</p>
</th>
        </tr>
      </thead>
      <!-- table header end -->
      <!-- table body start -->
    <tbody class="divide-y divide-gray-100">
<?php foreach ($transaksi as $t): ?>
<tr>

  <!-- Nama Siswa -->
  <td class="px-5 py-4 sm:px-6">
    <?= $t['nama_siswa']; ?>
  </td>

  <!-- Judul Buku -->
  <td class="px-5 py-4 sm:px-6">
    <?= $t['judul']; ?>
  </td>

  <!-- Kategori -->
  <td class="px-5 py-4 sm:px-6">
    <?= $t['nama_kategori']; ?>
  </td>

  <!-- Tanggal -->
  <td class="px-5 py-4 sm:px-6">
    <?= $t['tanggal_pinjam']; ?>
  </td>

  <!-- Status -->
  <td class="px-5 py-4 sm:px-6">
    <span class="px-2 py-1 text-xs rounded-lg 
      <?= $t['status'] == 'dipinjam' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700'; ?>">
      <?= $t['status']; ?>
    </span>
  </td>

</tr>
<?php endforeach; ?>
</tbody>
    </table>
  </div>
</div>
<!-- ====== Table Six End -->
                </div>
              </div>
            </div>
          </div>
        </main>
        <!-- ===== Main Content End ===== -->
      </div>
<?= $this->endSection(); ?>