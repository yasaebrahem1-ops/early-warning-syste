<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-[#F3F6FB]">
<head>
    <!-- سطر مكتبة Alpine.js للتفاعل -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أمانك | AMANK - Incident Management (إدارة البلاغات)</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome 6 Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Cairo Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        amankDark: '#0B1730',
                        amankBlue: '#1769FF',
                        amankBg: '#F3F6FB',
                        amankRed: '#E53935',
                        amankGreen: '#16A579',
                        amankAmber: '#F59E0B',
                        amankSidebarHover: '#132347'
                    },
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                    },
                    boxShadow: {
                        'card': '0 4px 20px -2px rgba(11, 23, 48, 0.05)',
                        'glow-blue': '0 8px 25px -5px rgba(23, 105, 255, 0.4)',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Cairo', sans-serif; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #F3F6FB; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="h-full flex overflow-hidden text-slate-800 antialiased">

    <!-- ===== 1. RIGHT SIDEBAR ===== -->
    <aside class="w-64 bg-amankDark text-white flex flex-col justify-between shrink-0 z-30 shadow-xl" dir="rtl">
        <div>
            <!-- Header / Logo -->
            <div class="h-20 flex items-center px-5 gap-3 border-b border-slate-800/80">
                <div class="w-10 h-10 bg-amankRed rounded-xl flex items-center justify-center text-white text-xl shadow-lg shadow-red-900/50 shrink-0">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div class="overflow-hidden">
                    <h1 class="text-lg font-extrabold tracking-wider text-white flex items-center gap-1.5">
                        AMANK <span class="text-[11px] font-semibold text-amankBlue">أمانك</span>
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
                    <span class="bg-red-500/20 text-red-400 text-[10px] font-bold px-2 py-0.5 rounded-full shrink-0">{{ count($incidents ?? []) }}</span>
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

        <!-- Sidebar User Footer -->
        <div class="p-3.5 border-t border-slate-800/80 bg-slate-900/40 m-3 rounded-2xl">
            <div class="flex items-center gap-3">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="User" class="w-9 h-9 rounded-xl object-cover ring-2 ring-amankBlue shrink-0">
                <div class="overflow-hidden">
                    <h4 class="text-xs font-bold text-white truncate">م. صبحي يوسف</h4>
                    <p class="text-[9px] text-slate-400 truncate">مدير غرفة العمليات</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT CONTAINER ===== -->
    <div class="flex-1 flex min-w-0 overflow-hidden">

        <!-- ===== CENTER: INCIDENTS TABLE & SEARCH ===== -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Navbar -->
            <header class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between shrink-0 z-10 shadow-sm">
                <div class="flex items-center gap-3">
                    <div>
                        <h2 class="text-base font-extrabold text-slate-800">إدارة البلاغات</h2>
                        <p class="text-[10px] text-slate-400 font-semibold">متابعة وتوجيه البلاغات الواردة من النظام الآلي والمواطنين</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-xl border border-slate-200">
                        مشغل: الصلاحية الكاملة
                    </span>
                </div>
            </header>

            <!-- Main Body Content -->
            <main class="flex-1 overflow-y-auto p-6 space-y-5">
                
                <!-- Filters & Search Bar Form -->
                <form action="{{ route('incidents.index') }}" method="GET" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-card flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-2 flex-1 min-w-[240px]">
                        <div class="relative w-full">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث بعنوان البلاغ، الموقع، أو نوع الحالة..." class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pr-9 pl-3 py-2 focus:outline-none focus:border-amankBlue">
                            <i class="fa-solid fa-magnifying-glass absolute right-3 top-2.5 text-slate-400 text-xs"></i>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold">
                        <button type="submit" class="bg-amankBlue text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition font-bold">بحث</button>
                        @if(request('search'))
                            <a href="{{ route('incidents.index') }}" class="bg-slate-200 text-slate-700 px-3 py-2 rounded-xl hover:bg-slate-300 transition">إلغاء</a>
                        @endif
                    </div>
                </form>

                <!-- Master Table (Dynamic from Database) -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-card overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-right text-xs">
                            <thead class="bg-slate-50 text-slate-400 font-bold border-b border-slate-100">
                                <tr>
                                    <th class="p-3.5">رقم البلاغ</th>
                                    <th class="p-3.5">العنوان / الحالة</th>
                                    <th class="p-3.5">نوع الطوارئ</th>
                                    <th class="p-3.5">الموقع</th>
                                    <th class="p-3.5">الإحداثيات (Lat, Lng)</th>
                                    <th class="p-3.5">التاريخ والوقت</th>
                                    <th class="p-3.5">الحالة</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                                @forelse($incidents ?? [] as $incident)
                                <tr class="hover:bg-slate-50/80 transition cursor-pointer @if($loop->first) bg-blue-50/40 @endif">
                                    <td class="p-3.5 font-extrabold text-amankBlue">#EMG-{{ $incident->id ?? 8091 }}</td>
                                    <td class="p-3.5 font-bold">{{ $incident->title ?? 'حادث سير عاجل' }}</td>
                                    <td class="p-3.5 text-amankRed font-bold"><i class="fa-solid fa-car-burst ml-1"></i> {{ $incident->type ?? 'حادث مرور' }}</td>
                                    <td class="p-3.5 text-slate-600">{{ $incident->location ?? 'شارع النصر - مدينة نصر' }}</td>
                                    <td class="p-3.5 text-slate-500 font-mono text-[11px]">{{ $incident->lat ?? '30.0444' }}, {{ $incident->lng ?? '31.2357' }}</td>
                                    <td class="p-3.5 text-slate-500">{{ isset($incident->created_at) ? $incident->created_at->diffForHumans() : 'منذ دقيقتين' }}</td>
                                    <td class="p-3.5">
                                        @if(($incident->status ?? 'active') == 'active')
                                            <span class="px-2.5 py-1 bg-amber-100 text-amankAmber rounded-full text-[11px] font-bold">جاري المتابعة</span>
                                        @else
                                            <span class="px-2.5 py-1 bg-emerald-100 text-amankGreen rounded-full text-[11px] font-bold">مكتمل</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center p-6 text-slate-400 font-bold">لا توجد بلاغات مسجلة حالياً تطابق بحثك.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>

        <!-- ===== LEFT: INCIDENT DETAIL & LIVE SNAPSHOT PANEL ===== -->
        <div class="w-80 bg-white border-r border-slate-200 flex flex-col shrink-0 z-20 shadow-xl overflow-y-auto">
            <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold text-amankRed bg-red-100 px-2 py-0.5 rounded-full">تفاصيل البلاغ النشط</span>
                    <h3 class="text-sm font-black text-slate-800 mt-1">البلاغات الحية الفورية</h3>
                </div>
            </div>

            <div class="p-4 space-y-4 text-xs">
                <!-- Camera Snapshot Preview -->
                <div class="rounded-xl overflow-hidden border border-slate-200 relative shadow-sm">
                    <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=500&auto=format&fit=crop&q=80" alt="Live Camera" class="w-full h-32 object-cover">
                    <div class="absolute top-2 right-2 bg-black/60 backdrop-blur text-white text-[9px] px-2 py-0.5 rounded font-bold flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span> كاميرا حية #44
                    </div>
                </div>

                <!-- Info Box -->
                <div class="space-y-2 bg-slate-50 p-3 rounded-xl border border-slate-100 font-semibold">
                    <div class="flex justify-between text-slate-600">
                        <span>إجمالي البلاغات:</span>
                        <span class="font-bold text-slate-800">{{ count($incidents ?? []) }} بلاغات</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>حالة النظام:</span>
                        <span class="font-bold text-amankGreen">متصل بقاعدة البيانات</span>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-2">
                    <button class="w-full bg-amankBlue text-white py-2.5 rounded-xl font-bold shadow-md hover:bg-blue-700 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i> تحديث وتوجيه الدعم
                    </button>
                </div>
            </div>
        </div>

    </div>

</body>
</html>