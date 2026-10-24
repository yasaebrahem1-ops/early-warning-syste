<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-[#F3F6FB]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أمانك | AMANK - Dashboard Overview (الصفحة الرئيسية)</title>
    <!-- سطر مكتبة Alpine.js للتفاعل -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome 6 Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Cairo Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Leaflet.js CSS & JS for Real Interactive Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

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
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F3F6FB;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Leaflet custom map markers styling */
        .custom-marker-pin {
            width: 32px;
            height: 32px;
            border-radius: 50% 50% 50% 0;
            position: absolute;
            transform: rotate(-45deg);
            left: 50%;
            top: 50%;
            margin: -20px 0 0 -16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.25);
            border: 2px solid #ffffff;
        }
        .custom-marker-pin i {
            transform: rotate(45deg);
            color: white;
            font-size: 14px;
        }
        .marker-red { background: #E53935; }
        .marker-blue { background: #1769FF; }
        .marker-amber { background: #F59E0B; }
        .marker-green { background: #16A579; }

        /* Custom pulsing marker background */
        .pulse-ring {
            border: 3px solid #E53935;
            -webkit-border-radius: 30px;
            height: 48px;
            width: 48px;
            position: absolute;
            left: -8px;
            top: -12px;
            -webkit-animation: pulsate 1.5s ease-out;
            -webkit-animation-iteration-count: infinite;
            opacity: 0;
        }
        @-webkit-keyframes pulsate {
            0% { -webkit-transform: scale(0.1, 0.1); opacity: 0.0; }
            50% { opacity: 1.0; }
            100% { -webkit-transform: scale(1.2, 1.2); opacity: 0.0; }
        }
    </style>
</head>
<body class="h-full flex overflow-hidden text-slate-800 antialiased selection:bg-amankBlue selection:text-white">

    <!-- ===== 1. RIGHT SIDEBAR (القائمة الجانبية الكحلي) ===== -->
    <aside class="w-64 bg-amankDark text-white flex flex-col justify-between shrink-0 z-30 shadow-xl transition-all duration-300">
        <div>
            <!-- Header / Logo -->
            <div class="h-20 flex items-center px-6 gap-3 border-b border-slate-800/80">
                <div class="w-10 h-10 bg-amankRed rounded-xl flex items-center justify-center text-white text-xl shadow-lg shadow-red-900/50">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h1 class="text-xl font-extrabold tracking-wider text-white">AMANK <span class="text-xs font-semibold text-amankBlue">أمانك</span></h1>
                    <p class="text-[10px] text-slate-400 font-medium">نظام الطوارئ والمرور الذكي</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-4 px-3 space-y-1.5">
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center flex-row-reverse justify-end gap-3.5 px-4 py-3 {{ request()->is('admin/dashboard') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                    <i class="fa-solid fa-chart-pie w-5 text-center text-base"></i>
                    <span class="text-right flex-1">الصفحة الرئيسية</span>
                </a>

                <a href="{{ url('/admin/live-map') }}" class="flex items-center flex-row-reverse justify-end gap-3.5 px-4 py-3 {{ request()->is('admin/live-map') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                    <i class="fa-solid fa-map-location-dot w-5 text-center text-base"></i>
                    <span class="text-right flex-1">الخريطة المباشرة</span>
                </a>

                <a href="{{ url('/admin/incidents') }}" class="flex items-center flex-row-reverse justify-end gap-3.5 px-4 py-3 {{ request()->is('admin/incidents') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                    <i class="fa-solid fa-triangle-exclamation w-5 text-center text-base"></i>
                    <span class="text-right flex-1">إدارة البلاغات</span>
                    <span class="bg-red-500/20 text-red-400 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $pendingIncidentsCount ?? 8 }}</span>
                </a>

                <a href="{{ url('/admin/fleet') }}" class="flex items-center flex-row-reverse justify-end gap-3.5 px-4 py-3 {{ request()->is('admin/fleet') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                    <i class="fa-solid fa-truck-medical w-5 text-center text-base"></i>
                    <span class="text-right flex-1">أسطول الطوارئ</span>
                </a>

                <a href="{{ url('/admin/smart-traffic') }}" class="flex items-center flex-row-reverse justify-end gap-3.5 px-4 py-3 {{ request()->is('admin/smart-traffic') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                    <i class="fa-solid fa-traffic-light w-5 text-center text-base"></i>
                    <span class="text-right flex-1">المرور الذكي و IoT</span>
                </a>

                <a href="{{ url('/admin/analytics') }}" class="flex items-center flex-row-reverse justify-end gap-3.5 px-4 py-3 {{ request()->is('admin/analytics') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                    <i class="fa-solid fa-chart-line w-5 text-center text-base"></i>
                    <span class="text-right flex-1">التحليلات والتقارير</span>
                </a>

                <a href="{{ url('/admin/settings') }}" class="flex items-center flex-row-reverse justify-end gap-3.5 px-4 py-3 {{ request()->is('admin/settings') ? 'bg-[#1769FF] text-white font-bold shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-[#132347] hover:text-white' }} rounded-xl transition text-xs">
                    <i class="fa-solid fa-sliders w-5 text-center text-base"></i>
                    <span class="text-right flex-1">الإعدادات والصلاحيات</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar User Footer -->
        <div class="p-4 border-t border-slate-800/80 bg-slate-900/40">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="User" class="w-10 h-10 rounded-xl object-cover ring-2 ring-amankBlue">
                    <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-amankGreen rounded-full ring-2 ring-amankDark"></span>
                </div>
                <div class="overflow-hidden">
                    <h4 class="text-xs font-bold text-white truncate">م. صبحي يوسف</h4>
                    <p class="text-[10px] text-slate-400 truncate">مدير غرفة العمليات المركزية</p>
                </div>
                <button class="mr-auto text-slate-400 hover:text-white transition p-1">
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                </button>
            </div>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT AREA ===== -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- ===== 2. TOP HEADER NAVBAR ===== -->
        <header class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between shrink-0 z-20 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 text-slate-800">
                    <i class="fa-solid fa-house-laptop text-amankBlue"></i>
                    <h2 class="text-base font-extrabold">لوحة التحكم - الصفحة الرئيسية</h2>
                </div>
                
                <!-- Quick Filter Dropdowns -->
                <div class="hidden md:flex items-center gap-2 mr-4 pr-4 border-r border-slate-200">
                    <select class="bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-700 rounded-lg px-3 py-1.5 focus:outline-none focus:border-amankBlue">
                        <option>القطاع: القاهرة الكبرى</option>
                        <option>قطاع الإسكندرية</option>
                        <option>قطاع الجيزة</option>
                    </select>
                    <select class="bg-slate-50 border border-slate-200 text-xs font-semibold text-slate-700 rounded-lg px-3 py-1.5 focus:outline-none focus:border-amankBlue">
                        <option>الحالة: جميع البلاغات</option>
                        <option>عاجل جداً</option>
                        <option>قيد المتابعة</option>
                    </select>
                </div>
            </div>

            <!-- Left Actions & Profile -->
            <div class="flex items-center gap-3">
                <!-- System Status Indicator -->
                <div class="hidden lg:flex items-center gap-2 bg-emerald-50 text-amankGreen border border-emerald-200 px-3 py-1 rounded-full text-xs font-bold">
                    <span class="w-2 h-2 rounded-full bg-amankGreen animate-ping"></span>
                    نظام أمانك متصل
                </div>

                <!-- Live Clock -->
                <div id="liveClock" class="text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                    14:38:05 - 2026/10/24
                </div>

                <!-- Notifications Button -->
                <button class="relative p-2 text-slate-500 hover:text-amankBlue hover:bg-slate-100 rounded-xl transition">
                    <i class="fa-solid fa-bell text-lg"></i>
                    <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-amankRed rounded-full ring-2 ring-white"></span>
                </button>

                <!-- User Quick Avatar -->
                <div class="flex items-center gap-2 pr-2 border-r border-slate-200">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" class="w-8 h-8 rounded-full border border-slate-200">
                    <span class="text-xs font-bold text-slate-700 hidden sm:inline">أدمن</span>
                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                </div>
            </div>
        </header>

        <!-- ===== DASHBOARD CONTENT CONTAINER ===== -->
        <main class="flex-1 overflow-y-auto p-4 lg:p-6 space-y-5">
            
            <!-- ===== 3. TOP STATS CARDS ROW ===== -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                
                <!-- Card 1: Active Filled Blue Card -->
                <div class="bg-amankBlue text-white rounded-2xl p-4 shadow-glow-blue flex items-center justify-between relative overflow-hidden">
                    <div class="z-10">
                        <div class="flex items-center gap-2 text-blue-100 text-xs font-bold mb-1">
                            <span>إجمالي بلاغات اليوم</span>
                            <span class="bg-white/20 text-white text-[10px] px-1.5 py-0.5 rounded">+15%</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl font-black">{{ $totalTodayIncidents ?? 15 }}</span>
                            <span class="text-xs font-semibold text-blue-100">بلاغ جديد</span>
                        </div>
                        <p class="text-[11px] text-blue-200 mt-2 font-medium">12 قيد المتابعة | 3 مكتمل</p>
                    </div>
                    <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-3xl text-white backdrop-blur-sm z-10">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                    <div class="absolute -left-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                </div>

                <!-- Card 2: Road Accidents (White Card) -->
                <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-card flex items-center justify-between hover:border-amankBlue/30 transition">
                    <div>
                        <span class="text-xs font-bold text-slate-400">حوادث الطريق النشطة</span>
                        <div class="flex items-baseline gap-2 mt-1">
                            <span class="text-3xl font-black text-slate-800">{{ $roadAccidentsCount ?? 8 }}</span>
                            <span class="text-xs font-semibold text-amankRed">بلاغ عاجل</span>
                        </div>
                        <p class="text-[11px] text-slate-500 mt-2 flex items-center gap-1">
                            <i class="fa-solid fa-clock text-amber-500"></i> متوسط الاستجابة: 4 دقائق
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-blue-50 text-amankBlue rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-car-burst"></i>
                    </div>
                </div>

                <!-- Card 3: Emergency Cases -->
                <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-card flex items-center justify-between hover:border-amankRed/30 transition">
                    <div>
                        <span class="text-xs font-bold text-slate-400">حالات طوارئ حرجة</span>
                        <div class="flex items-baseline gap-2 mt-1">
                            <span class="text-3xl font-black text-amankRed">{{ $criticalCasesCount ?? 5 }}</span>
                            <span class="text-xs font-semibold text-slate-500">حالة طوارئ</span>
                        </div>
                        <p class="text-[11px] text-slate-500 mt-2 flex items-center gap-1">
                            <i class="fa-solid fa-fire text-amankRed"></i> 2 إطفاء | 3 مساعدة طبية
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-red-50 text-amankRed rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-truck-droplet"></i>
                    </div>
                </div>

                <!-- Card 4: Available Fleet Units -->
                <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-card flex items-center justify-between hover:border-amankGreen/30 transition">
                    <div>
                        <span class="text-xs font-bold text-slate-400">وحدات الطوارئ المتاحة</span>
                        <div class="flex items-baseline gap-2 mt-1">
                            <span class="text-3xl font-black text-slate-800">{{ $availableFleetCount ?? 12 }}</span>
                            <span class="text-xs font-semibold text-amankGreen">وحدة جاهزة</span>
                        </div>
                        <p class="text-[11px] text-slate-500 mt-2 flex items-center gap-1">
                            <i class="fa-solid fa-circle-check text-amankGreen"></i> تغطية 94% من القطاع
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-emerald-50 text-amankGreen rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                </div>

            </div>

            <!-- ===== 4. MAIN GRID LAYOUT (MAP + LOG + RIGHT ALERTS PANEL) ===== -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                
                <!-- LEFT/CENTER COLUMN (2 COLS): LIVE MAP & INCIDENTS TABLE -->
                <div class="lg:col-span-2 space-y-5">
                    
                    <!-- A. INTERACTIVE LIVE MAP CONTAINER -->
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-card p-4 relative flex flex-col">
                        <div class="flex items-center justify-between mb-3 px-1">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-amankRed animate-pulse"></span>
                                <h3 class="text-sm font-extrabold text-slate-800">خريطة الحوادث المباشرة وتتبع الأسطول</h3>
                                <span class="text-[11px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full font-bold">تحديث حي GPS</span>
                            </div>
                            
                            <!-- Map Controls Legend -->
                            <div class="flex items-center gap-3 text-xs font-semibold text-slate-600">
                                <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded-full bg-amankRed"></span> حادث</span>
                                <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded-full bg-amankBlue"></span> إسعاف</span>
                                <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded-full bg-amankAmber"></span> مرور</span>
                                <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded-full bg-amankGreen"></span> دورية</span>
                            </div>
                        </div>

                        <!-- Leaflet Canvas Container -->
                        <div id="liveMap" class="w-full h-80 rounded-xl border border-slate-200 z-10"></div>
                        
                        <!-- Map Overlay Toolbar Footer -->
                        <div class="flex items-center justify-between mt-3 px-1 text-xs text-slate-500 font-semibold">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-location-crosshairs text-amankBlue"></i>
                                <span>المركز المحدد: القاهرة (30.0444° N, 31.2357° E)</span>
                            </div>
                            <button onclick="recenterMap()" class="text-amankBlue hover:underline flex items-center gap-1">
                                <i class="fa-solid fa-rotate-right"></i> إعادة توجيه الخريطة
                            </button>
                        </div>
                    </div>

                    <!-- B. LIVE INCIDENT LOG TABLE -->
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-card overflow-hidden">
                        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-extrabold text-slate-800">سجل البلاغات والحوادث الحالية</h3>
                                <p class="text-[11px] text-slate-400 font-medium">يتم التحديث فور إرسال البلاغ من تطبيق المواطن</p>
                            </div>
                            <a href="{{ url('/admin/incidents') }}" class="text-xs font-bold text-amankBlue hover:bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100 transition">
                                عرض كل البلاغات ←
                            </a>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-right text-xs">
                                <thead class="bg-slate-50 text-slate-400 font-bold border-b border-slate-100">
                                    <tr>
                                        <th class="p-3.5">رقم البلاغ</th>
                                        <th class="p-3.5">اسم المبلغ</th>
                                        <th class="p-3.5">نوع الطوارئ</th>
                                        <th class="p-3.5">الموقع</th>
                                        <th class="p-3.5">وقت الاستجابة</th>
                                        <th class="p-3.5 text-center">الحالة</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                                    
                                    @forelse($incidents ?? [] as $incident)
                                    <tr class="hover:bg-slate-50/80 transition">
                                        <td class="p-3.5 font-extrabold text-amankBlue">{{ $incident->code ?? '#EMG-8091' }}</td>
                                        <td class="p-3.5">
                                            <div class="font-bold text-slate-800">{{ $incident->reporter_name ?? 'أحمد محمود' }}</div>
                                            <span class="text-[10px] text-slate-400">{{ $incident->phone ?? '01012345678' }}</span>
                                        </td>
                                        <td class="p-3.5 text-amankRed font-bold">
                                            <i class="fa-solid fa-car-burst ml-1"></i> {{ $incident->type ?? 'حادث سير' }}
                                        </td>
                                        <td class="p-3.5 text-slate-600">{{ $incident->location ?? 'شارع النصر - مدينة نصر' }}</td>
                                        <td class="p-3.5 font-bold text-slate-800">{{ $incident->response_time ?? '03:45' }} دقيقة</td>
                                        <td class="p-3.5 text-center">
                                            <span class="px-2.5 py-1 bg-amber-50 text-amankAmber border border-amber-200 rounded-full text-[11px] font-bold">
                                                {{ $incident->status ?? 'جاري المتابعة' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <!-- Row 1 (Default Fallback) -->
                                    <tr class="hover:bg-slate-50/80 transition">
                                        <td class="p-3.5 font-extrabold text-amankBlue">#EMG-8091</td>
                                        <td class="p-3.5">
                                            <div class="font-bold text-slate-800">أحمد محمود</div>
                                            <span class="text-[10px] text-slate-400">01012345678</span>
                                        </td>
                                        <td class="p-3.5 text-amankRed font-bold">
                                            <i class="fa-solid fa-car-burst ml-1"></i> حادث سير
                                        </td>
                                        <td class="p-3.5 text-slate-600">شارع النصر - مدينة نصر</td>
                                        <td class="p-3.5 font-bold text-slate-800">03:45 دقيقة</td>
                                        <td class="p-3.5 text-center">
                                            <span class="px-2.5 py-1 bg-amber-50 text-amankAmber border border-amber-200 rounded-full text-[11px] font-bold">
                                                جاري المتابعة
                                            </span>
                                        </td>
                                    </tr>

                                    <!-- Row 2 -->
                                    <tr class="hover:bg-slate-50/80 transition">
                                        <td class="p-3.5 font-extrabold text-amankBlue">#EMG-8090</td>
                                        <td class="p-3.5">
                                            <div class="font-bold text-slate-800">سارة علي</div>
                                            <span class="text-[10px] text-slate-400">01198765432</span>
                                        </td>
                                        <td class="p-3.5 text-amber-600 font-bold">
                                            <i class="fa-solid fa-kit-medical ml-1"></i> طلب مساعدة طبية
                                        </td>
                                        <td class="p-3.5 text-slate-600">طريق السويس - الكيلو 21</td>
                                        <td class="p-3.5 font-bold text-slate-800">05:10 دقيقة</td>
                                        <td class="p-3.5 text-center">
                                            <span class="px-2.5 py-1 bg-blue-50 text-amankBlue border border-blue-200 rounded-full text-[11px] font-bold">
                                                وحدة في الطريق
                                            </span>
                                        </td>
                                    </tr>

                                    <!-- Row 3 -->
                                    <tr class="hover:bg-slate-50/80 transition">
                                        <td class="p-3.5 font-extrabold text-amankBlue">#EMG-8089</td>
                                        <td class="p-3.5">
                                            <div class="font-bold text-slate-800">محمود توفيق</div>
                                            <span class="text-[10px] text-slate-400">01233445566</span>
                                        </td>
                                        <td class="p-3.5 text-amankGreen font-bold">
                                            <i class="fa-solid fa-traffic-light ml-1"></i> تعطل حركة المرور
                                        </td>
                                        <td class="p-3.5 text-slate-600">ميدان التحرير</td>
                                        <td class="p-3.5 font-bold text-slate-800">02:15 دقيقة</td>
                                        <td class="p-3.5 text-center">
                                            <span class="px-2.5 py-1 bg-emerald-50 text-amankGreen border border-emerald-200 rounded-full text-[11px] font-bold">
                                                مكتمل
                                            </span>
                                        </td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN (1 COL): REAL-TIME ALERT NOTIFICATIONS SIDE PANEL -->
                <div class="space-y-5">
                    
                    <!-- INCIDENT ALERTS CARD PANEL -->
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-card p-4 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-bell text-amankRed"></i>
                                    <h3 class="text-sm font-extrabold text-slate-800">التنبيهات العاجلة الواردة</h3>
                                </div>
                                <span class="bg-red-100 text-amankRed text-[10px] font-bold px-2 py-0.5 rounded-full">3 جديدة</span>
                            </div>

                            <!-- Alert Cards Vertical Stack -->
                            <div class="space-y-3">
                                
                                <!-- Critical Alert 1 (Red Accent) -->
                                <div class="p-3 bg-red-50/80 border-r-4 border-amankRed rounded-xl space-y-1.5 transition hover:shadow-sm">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black text-amankRed flex items-center gap-1">
                                            <i class="fa-solid fa-triangle-exclamation"></i> حادث تصادم 3 سيارات
                                        </span>
                                        <span class="text-[10px] text-slate-400 font-semibold">منذ دقيقتين</span>
                                    </div>
                                    <p class="text-xs text-slate-700 font-semibold leading-relaxed">
                                        شارع التسعين الشمالي، التجمع الخامس. يتطلب تدخل عاجل للإسعاف والحماية المدنية.
                                    </p>
                                    <div class="flex items-center justify-between pt-1">
                                        <span class="text-[10px] font-bold text-slate-500">الوحدة الموجهة: إسعاف 102</span>
                                        <button class="bg-amankRed text-white text-[10px] font-bold px-2.5 py-1 rounded-lg hover:bg-red-700 transition">
                                            متابعة البلاغ
                                        </button>
                                    </div>
                                </div>

                                <!-- Alert 2 (Blue Accent - Dispatch) -->
                                <div class="p-3 bg-blue-50/80 border-r-4 border-amankBlue rounded-xl space-y-1.5 transition hover:shadow-sm">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black text-amankBlue flex items-center gap-1">
                                            <i class="fa-solid fa-truck-medical"></i> تحرك سيارة الإسعاف
                                        </span>
                                        <span class="text-[10px] text-slate-400 font-semibold">منذ 8 دقائق</span>
                                    </div>
                                    <p class="text-xs text-slate-700 font-semibold leading-relaxed">
                                        الوحدة 14 تتجه إلى موقع البلاغ #EMG-8090 عبر الطريق الدائري.
                                    </p>
                                    <div class="flex items-center justify-between pt-1">
                                        <span class="text-[10px] font-bold text-slate-500">الوقت المتوقع: 6 دقائق</span>
                                        <button class="bg-amankBlue text-white text-[10px] font-bold px-2.5 py-1 rounded-lg hover:bg-blue-700 transition">
                                            تتبع المسار
                                        </button>
                                    </div>
                                </div>

                                <!-- Alert 3 (Green Accent - Arrival) -->
                                <div class="p-3 bg-emerald-50/80 border-r-4 border-amankGreen rounded-xl space-y-1.5 transition hover:shadow-sm">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-black text-amankGreen flex items-center gap-1">
                                            <i class="fa-solid fa-circle-check"></i> وصول دورية المرور
                                        </span>
                                        <span class="text-[10px] text-slate-400 font-semibold">منذ 15 دقيقة</span>
                                    </div>
                                    <p class="text-xs text-slate-700 font-semibold leading-relaxed">
                                        وصلت الدورية #402 لموقع البلاغ #EMG-8089 وجاري تنظيم حركة السير.
                                    </p>
                                    <div class="flex items-center justify-between pt-1">
                                        <span class="text-[10px] font-bold text-amankGreen">الحالة: تحت السيطرة</span>
                                        <button class="bg-slate-200 text-slate-700 text-[10px] font-bold px-2.5 py-1 rounded-lg hover:bg-slate-300 transition">
                                            التفاصيل
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- System Quick Stats Footer -->
                        <div class="mt-5 pt-4 border-t border-slate-100 bg-slate-50/50 p-3 rounded-xl">
                            <div class="flex items-center justify-between text-xs font-bold text-slate-700">
                                <span>جاهزية أسطول الإسعاف:</span>
                                <span class="text-amankGreen">92%</span>
                            </div>
                            <div class="w-full bg-slate-200 h-2 rounded-full mt-2 overflow-hidden">
                                <div class="bg-amankGreen h-full rounded-full" style="width: 92%"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </main>
    </div>

    <!-- ===== LEAFLET MAP & INTERACTIVE SCRIPT ===== -->
    <script>
        let map;

        // Initialize Map
        window.onload = function() {
            // Live Clock Update
            setInterval(() => {
                const now = new Date();
                const timeString = now.toLocaleTimeString('ar-EG', { hour12: false });
                const dateString = now.toLocaleDateString('ar-EG');
                document.getElementById('liveClock').innerText = `${timeString} - ${dateString}`;
            }, 1000);

            // Center Cairo Map Coordinates
            const cairoCoords = [30.0444, 31.2357];
            
            map = L.map('liveMap', {
                zoomControl: false
            }).setView(cairoCoords, 12);

            // Light clean OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© AMANK Smart System'
            }).addTo(map);

            // Add Zoom Control to Bottom Left
            L.control.zoom({ position: 'bottomleft' }).addTo(map);

            // Custom Leaflet Icons Generator
            function createCustomIcon(colorClass, iconFa) {
                return L.divIcon({
                    className: 'custom-div-icon',
                    html: `
                        <div class="custom-marker-pin ${colorClass}">
                            <i class="fa-solid ${iconFa}"></i>
                        </div>
                    `,
                    iconSize: [30, 42],
                    iconAnchor: [15, 42]
                });
            }

            // Real simulated Incident & Fleet Markers
            const incident1 = L.marker([30.0550, 31.2800], { icon: createCustomIcon('marker-red', 'fa-car-burst') }).addTo(map);
            incident1.bindPopup('<b>حادث سير عاجل #EMG-8091</b><br>شارع النصر - مدينة نصر');

            const incident2 = L.marker([30.0100, 31.2100], { icon: createCustomIcon('marker-amber', 'fa-kit-medical') }).addTo(map);
            incident2.bindPopup('<b>حالة طوارئ طبية #EMG-8090</b><br>المعادي - شارع 9');

            const ambulance1 = L.marker([30.0350, 31.2500], { icon: createCustomIcon('marker-blue', 'fa-truck-medical') }).addTo(map);
            ambulance1.bindPopup('<b>سيارة إسعاف وحدة 102</b><br>في الطريق لموقع الحادث');

            const patrol1 = L.marker([30.0700, 31.3000], { icon: createCustomIcon('marker-green', 'fa-shield-halved') }).addTo(map);
            patrol1.bindPopup('<b>دورية مرور نشطة</b><br>مصر الجديدة');

            // Draw simulated emergency route line
            const routeCoords = [
                [30.0350, 31.2500],
                [30.0450, 31.2650],
                [30.0550, 31.2800]
            ];
            L.polyline(routeCoords, {
                color: '#1769FF',
                weight: 4,
                opacity: 0.8,
                dashArray: '8, 8'
            }).addTo(map);
        };

        function recenterMap() {
            if(map) {
                map.setView([30.0444, 31.2357], 12);
            }
        }
    </script>
</body>
</html>