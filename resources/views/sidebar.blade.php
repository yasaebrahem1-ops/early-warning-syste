<aside class="w-64 bg-[#0B1730] text-white flex flex-col justify-between shrink-0 z-30 shadow-xl h-screen select-none" dir="rtl">
    <div>
        <!-- Header / Logo -->
        <div class="h-20 flex items-center px-5 gap-3 border-b border-slate-800/80">
            <div class="w-10 h-10 bg-[#E53935] rounded-xl flex items-center justify-center text-white text-xl shadow-lg shadow-red-900/50 shrink-0">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div class="overflow-hidden">
                <h1 class="text-lg font-extrabold tracking-wider text-white flex items-center gap-1.5">
                    AMANK <span class="text-[11px] font-semibold text-[#1769FF]">أمانك</span>
                </h1>
                <p class="text-[9px] text-slate-400 font-medium truncate">نظام الطوارئ والمرور الذكي</p>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="mt-4 px-3 space-y-1.5">
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/dashboard') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                <i class="fa-solid fa-chart-pie w-5 text-center text-base shrink-0"></i>
                <span class="truncate">الصفحة الرئيسية</span>
            </a>

            <a href="{{ url('/admin/live-map') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/live-map') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                <i class="fa-solid fa-map-location-dot w-5 text-center text-base shrink-0"></i>
                <span class="truncate">الخريطة المباشرة</span>
            </a>

            <a href="{{ url('/admin/incidents') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/incidents') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                <i class="fa-solid fa-triangle-exclamation w-5 text-center text-base shrink-0"></i>
                <span class="truncate flex-1">إدارة البلاغات</span>
                <span class="bg-red-500/20 text-red-400 text-[10px] font-bold px-2 py-0.5 rounded-full shrink-0">8</span>
            </a>

            <a href="{{ url('/admin/fleet') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/fleet') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                <i class="fa-solid fa-truck-medical w-5 text-center text-base shrink-0"></i>
                <span class="truncate">أسطول الطوارئ</span>
            </a>

            <a href="{{ url('/admin/smart-traffic') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/smart-traffic') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                <i class="fa-solid fa-traffic-light w-5 text-center text-base shrink-0"></i>
                <span class="truncate">المرور الذكي و IoT</span>
            </a>

            <a href="{{ url('/admin/analytics') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/analytics') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                <i class="fa-solid fa-chart-line w-5 text-center text-base shrink-0"></i>
                <span class="truncate">التحليلات والتقارير</span>
            </a>

            <a href="{{ url('/admin/settings') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/settings') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                <i class="fa-solid fa-sliders w-5 text-center text-base shrink-0"></i>
                <span class="truncate">الإعدادات والصلاحيات</span>
            </a>
        </nav>
    </div>

    <!-- User Footer Profile -->
    <div class="p-3.5 border-t border-slate-800/80 bg-slate-900/40 m-3 rounded-2xl">
        <div class="flex items-center gap-3">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="User" class="w-9 h-9 rounded-xl object-cover ring-2 ring-[#1769FF] shrink-0">
            <div class="overflow-hidden">
                <h4 class="text-xs font-bold text-white truncate">م. صبحي يوسف</h4>
                <p class="text-[9px] text-slate-400 truncate">مدير غرفة العمليات</p>
            </div>
        </div>
    </div>
</aside>