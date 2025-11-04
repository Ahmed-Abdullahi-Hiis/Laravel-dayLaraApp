<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Blogger Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-indigo-700 text-white flex-shrink-0 h-screen flex flex-col">
      <!-- Header -->
      <div class="p-6 text-xl font-bold border-b border-indigo-600">
        Blogger Panel
      </div>

      <!-- Navigation -->
      <nav class="mt-6 flex-1 flex flex-col gap-2 px-2">
        
        <!-- Dashboard -->
        <a href="{{ route('blogger.dashboard') }}" 
           class="flex items-center gap-3 px-4 py-2 bg-indigo-600 rounded-lg hover:bg-indigo-500 transition duration-200 font-medium text-white">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3 13h8V3H3v10zm10 8h8v-6h-8v6zm0-8h8V3h-8v10zm-10 8h8v-6H3v6z"/>
          </svg>
          Dashboard
        </a>

        <!-- View All Blogs (same style as Admin “View Blogs”) -->
        <a href="{{ route('blogger.blogs.index') }}" 
           class="flex items-center gap-3 px-4 py-2 bg-indigo-600 rounded-lg hover:bg-indigo-500 transition duration-200 font-medium text-white">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h10v2H4v-2z"/>
          </svg>
          My Blogs
        </a>

        <!-- Create New Blog -->
        <a href="{{ route('blogger.blogs.create') }}" 
           class="flex items-center gap-3 px-4 py-2 bg-indigo-600 rounded-lg hover:bg-indigo-500 transition duration-200 font-medium text-white">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
          </svg>
          Create Blog
        </a>

        <!-- Reports (optional for bloggers to see their blog stats) -->
        <a href="{{ route('blogger.reports') }}" 
           class="flex items-center gap-3 px-4 py-2 bg-indigo-600 rounded-lg hover:bg-indigo-500 transition duration-200 font-medium text-white">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3 3h18v2H3V3zm0 4h18v2H3V7zm0 4h12v2H3v-2zm0 4h12v2H3v-2zm0 4h12v2H3v-2z"/>
          </svg>
          Reports
        </a>

        <!-- Settings -->
        <a href="{{ route('blogger.settings') }}" 
           class="flex items-center gap-3 px-4 py-2 bg-indigo-600 rounded-lg hover:bg-indigo-500 transition duration-200 font-medium text-white">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 8a4 4 0 100 8 4 4 0 000-8zm0-5a1 1 0 011 1v1.07a7.003 7.003 0 013.9 1.65l.76-.44a1 1 0 011.37.45l.86 1.49a1 1 0 01-.45 1.37l-.76.44A7.003 7.003 0 0120.93 11H22a1 1 0 011 1v2a1 1 0 01-1 1h-1.07a7.003 7.003 0 01-1.65 3.9l.44.76a1 1 0 01-.45 1.37l-1.49.86a1 1 0 01-1.37-.45l-.44-.76a7.003 7.003 0 01-3.9 1.65V22a1 1 0 01-1 1h-2a1 1 0 01-1-1v-1.07a7.003 7.003 0 01-3.9-1.65l-.76.44a1 1 0 01-1.37-.45l-.86-1.49a1 1 0 01.45-1.37l.76-.44A7.003 7.003 0 013.07 13H2a1 1 0 01-1-1v-2a1 1 0 011-1h1.07a7.003 7.003 0 011.65-3.9l-.44-.76a1 1 0 01.45-1.37l1.49-.86a1 1 0 011.37.45l.44.76A7.003 7.003 0 0111 3.07V2a1 1 0 011-1h2z"/>
          </svg>
          Settings
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Top Navbar -->
      <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Blogger Dashboard</h1>
        <div class="flex items-center space-x-4">
          <span class="text-gray-600">{{ Auth::user()->name }}</span>
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="text-sm text-red-600 hover:underline">
                  Logout
              </button>
          </form>
        </div>
      </header>

      <!-- Content Area -->
      <main class="p-6 overflow-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">My Blogs</h2>
            <p>You have <strong>3</strong> blogs published.</p>
          </div>

          <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Drafts</h2>
            <p><strong>2</strong> drafts waiting for review.</p>
          </div>

          <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Profile</h2>
            <p>Keep your blogger profile up to date.</p>
          </div>
        </div>
      </main>
    </div>
  </div>

</body>
</html>
