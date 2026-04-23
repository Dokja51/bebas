<?= $this->extend('part/index'); ?>
<?= $this->section('content'); ?>

<main>
  <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">

    <form action="/store_user" method="post">

      <!-- Header -->
      <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
          Tambah User
        </h2>
      </div>

      <!-- Card -->
      <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-6 space-y-5">

        <!-- Username -->
        <div>
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
            Username
          </label>
          <input
            name="username"
            type="text"
            placeholder="Username"
            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 placeholder:text-gray-400
            focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
            required
          />
        </div>

        <!-- Email -->
        <div>
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
            Email
          </label>
          <input
            name="email"
            type="email"
            placeholder="Email"
            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 placeholder:text-gray-400
            focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
            required
          />
        </div>

        <!-- Password -->
        <div>
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
            Password
          </label>
          <input
            name="password"
            type="password"
            placeholder="Password"
            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 placeholder:text-gray-400
            focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
            required
          />
        </div>

        <!-- Role -->
        <div>
          <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
            Role
          </label>
          <select
            name="group"
            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800
            focus:border-gray-400 focus:ring-2 focus:ring-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
          >
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        </div>

        <!-- Button -->
        <button
          type="submit"
          class="inline-flex items-center justify-center rounded-lg bg-gray-800 px-5 py-3 text-sm font-medium text-white
          hover:bg-gray-900 transition dark:bg-gray-700 dark:hover:bg-gray-600"
        >
          Simpan User
        </button>

      </div>

    </form>

  </div>
</main>

<?= $this->endSection(); ?>