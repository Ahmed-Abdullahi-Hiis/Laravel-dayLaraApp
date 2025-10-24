<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Sidebar -->
  <div class="flex h-screen">
    <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
      <div class="p-6 text-xl font-bold border-b border-gray-700">Admin Panel</div>
      <nav class="mt-6"> 
        <a href="dashboard" class="block py-2.5 px-4 hover:bg-gray-700">Dashboard</a>
        <a href="#" class="block py-2.5 px-4 hover:bg-gray-700">Users</a>
        <a href="#" class="block py-2.5 px-4 hover:bg-gray-700">Settings</a>
        <a href="#" class="block py-2.5 px-4 hover:bg-gray-700">Reports</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Top Navbar -->
      <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Dashboard</h1>
        <div class="flex items-center space-x-4">
          <span class="text-gray-600">Admin</span>
          <img src="https://via.placeholder.com/32" alt="Avatar" class="rounded-full w-8 h-8" />
        </div>
      </header>

      <!-- Content Area -->
      <main class="p-6 overflow-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Users</h2>
            <p>1,245 active users</p>
          </div>
          <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Sales</h2>
            <p>$23,400 this month</p>
          </div>
          <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Performance</h2>
            <p>87% uptime</p>
          </div>
        </div>
      </main>
    </div>
  </div>

</body>
</html>