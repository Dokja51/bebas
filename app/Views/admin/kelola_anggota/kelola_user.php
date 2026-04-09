<?= $this->extend('part/index'); ?>
<?= $this->section('content'); ?>

<main>
  <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">

    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
      <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
        Kelola User
      </h2>

      <a href="<?= base_url('create_user') ?>"
        class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600">
        + Tambah User
      </a>
    </div>

    <div class="space-y-5 sm:space-y-6">
      <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        
        <div class="px-5 py-4 sm:px-6 sm:py-5">
          <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            Data User
          </h3>
        </div>

        <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">

          <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-800">
            <div class="max-w-full overflow-x-auto">

              <table class="min-w-full">

                <!-- HEADER -->
                <thead>
                  <tr class="border-b border-gray-100 dark:border-gray-800">
                    <th class="px-5 py-3 sm:px-6">
                      <p class="font-medium text-gray-500 text-theme-xs">No</p>
                    </th>

                    <th class="px-5 py-3 sm:px-6">
                      <p class="font-medium text-gray-500 text-theme-xs">Email</p>
                    </th>

                    <th class="px-5 py-3 sm:px-6">
                      <p class="font-medium text-gray-500 text-theme-xs">Role</p>
                    </th>

                    <th class="px-5 py-3 sm:px-6">
                      <p class="font-medium text-gray-500 text-theme-xs">Aksi</p>
                    </th>
                  </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                  <?php $no = 1; ?>

                  <?php if (!empty($users)): ?>
                    <?php foreach ($users as $u): ?>
                    <tr>

                      <!-- NO -->
                      <td class="px-5 py-4 sm:px-6">
                        <span class="text-gray-500 text-theme-sm">
                          <?= $no++; ?>
                        </span>
                      </td>

                      <!-- EMAIL -->
                      <td class="px-5 py-4 sm:px-6">
                        <span class="text-gray-500 text-theme-sm">
                          <?= $u['email'] ?? '-'; ?>
                        </span>
                      </td>

                      <!-- ROLE -->
                      <td class="px-5 py-4 sm:px-6">
                        <?php
                          $role = $u['group'] ?? 'user';
                          $color = ($role == 'admin') ? 'bg-red-500' : 'bg-blue-500';
                        ?>
                        <span class="px-2 py-1 text-xs text-white rounded <?= $color ?>">
                          <?= ucfirst($role); ?>
                        </span>
                      </td>

                      <!-- AKSI -->
                      <td class="px-5 py-4 sm:px-6">
                        <div class="flex items-center gap-2">

                          <!-- EDIT -->
                          <a href="/edit_user/<?= $u['id']; ?>"
                            class="inline-flex items-center gap-2 rounded-lg bg-yellow-500 px-3 py-2 text-sm text-white hover:bg-yellow-600">
                            Edit
                          </a>

                          <!-- DELETE -->
                          <form action="/hapus_user/<?= $u['id']; ?>" method="post"
                            onsubmit="return confirm('Yakin hapus user ini?')">
                            <?= csrf_field(); ?>
                            <button type="submit"
                              class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700">
                              Hapus
                            </button>
                          </form>

                        </div>
                      </td>

                    </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="4" class="text-center py-6 text-gray-500">
                        Tidak ada data user
                      </td>
                    </tr>
                  <?php endif; ?>

                </tbody>

              </table>

            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</main>

<?= $this->endSection(); ?>