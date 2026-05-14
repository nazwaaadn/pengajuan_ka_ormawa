<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
    <div>
        {{-- Judul Sidebar --}}
        {{-- <h1 class="font-bold justify-content-center justify-center text-center text-gray-900">
            Pengajuan ketua ormawa
        </h1> --}}
        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200">
        </ul>
    </div>
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
       <ul class="space-y-2 font-medium">
          <li class="{{ Request::is('#') ? 'active' : '' }}">
             <a href="#" class="flex items-center p-2 text-sm text-gray-900 rounded-lg hover:bg-gray-100 group {{ Request::is('/') ? 'bg-gray-100 text-white' : 'text-gray-900' }}">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Request::is('#') ? 'text-gray-900' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                   <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                   <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3">Pengajuan Ketua ORMAWA</span>
             </a>
          </li>
          <li class="{{ Request::is('pengajuanpusat') ? 'active' : '' }}">
            <a href="{{ url('/pengajuanpusat') }}" class="flex items-center p-2 rounded-lg group hover:bg-gray-100 {{ Request::is('pengajuanpusat') ? 'bg-gray-100 text-gray-900' : '' }}">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Request::is('pengajuanpusat') ? 'text-gray-900' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd"/>
              </svg>
               <span class="ms-3 whitespace-nowrap">MPM dan BEM</span>
            </a>
         </li>
          <li class="{{ Request::is('pengajuanhimpunan') ? 'active' : '' }}">
            <a href="{{ url('/pengajuanhimpunan') }}" class="flex items-center p-2 rounded-lg group hover:bg-gray-100 {{ Request::is('pengajuanhimpunan') ? 'bg-gray-100 text-gray-900' : '' }}">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Request::is('pengajuanhimpunan') ? 'text-gray-900' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd"/>
                </svg>
                <span class="ms-3 whitespace-nowrap">Himpunan</span>
             </a>
          </li>
          <li class="{{ Request::is('pengajuanukm') ? 'active' : '' }}">
            <a href="{{ url('/pengajuanukm') }}" class="flex items-center p-2 rounded-lg group hover:bg-gray-100 {{ Request::is('pengajuanukm') ? 'bg-gray-100 text-gray-900' : '' }}">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 {{ Request::is('pengajuanukm') ? 'text-gray-900' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd"/>
                </svg>
               <span class="ms-3 whitespace-nowrap">UKM</span>
            </a>
         </li>
       </ul>
    </div>
</aside>
