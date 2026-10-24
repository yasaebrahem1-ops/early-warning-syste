<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-[#F3F6FB]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أمانك | AMANK - Emergency Fleet (أسطول الطوارئ)</title>
    
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
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #F3F6FB; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .custom-marker-pin {
            width: 28px;
            height: 28px;
            border-radius: 50% 50% 50% 0;
            position: absolute;
            transform: rotate(-45deg);
            left: 50%;
            top: 50%;
            margin: -18px 0 0 -14px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 8px rgba(0,0,0,0.25);
            border: 2px solid #ffffff;
        }
        .custom-marker-pin i {
            transform: rotate(45deg);
            color: white;
            font-size: 12px;
        }
        .marker-red { background: #E53935; }
        .marker-blue { background: #1769FF; }
        .marker-amber { background: #F59E0B; }
        .marker-green { background: #16A579; }
    </style>
</head>
<body class="h-full flex overflow-hidden text-slate-800 antialiased">

    <!-- ===== SHARED SIDEBAR ===== -->
    @include('sidebar')

    <!-- ===== MAIN CONTENT CONTAINER ===== -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <!-- ===== TOP NAVBAR ===== -->
        <header class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between shrink-0 z-10 shadow-sm">
            <div class="flex items-center gap-3">
                <div>
                    <h2 class="text-base font-extrabold text-slate-800">أسطول الطوارئ (Emergency Fleet)</h2>
                    <p class="text-[10px] text-slate-400 font-semibold">متابعة وتوجيه الوحدات المتنقلة وحالة الجاهزية الميدانية</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-amankGreen bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-200 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-amankGreen animate-ping"></span> نظام تتبع الأسطول متصل
                </span>
            </div>
        </header>

        <!-- ===== MAIN BODY CONTAINER ===== -->
        <main class="flex-1 overflow-y-auto p-5 space-y-5">
            
            <!-- ===== 1. TOP STATS CARDS ROW ===== -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                
                <!-- Card 1 -->
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-card flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold text-slate-400">إجمالي الأسطول</span>
                        <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $totalFleet ?? '25 وحدة' }}</h3>
                        <p class="text-[10px] text-amankBlue mt-1 font-semibold">تغطية القطاع بالكامل</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 text-amankBlue rounded-2xl flex items-center justify-center text-xl">
                        <i class="fa-solid fa-truck-medical"></i>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-card flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold text-slate-400">الوحدات المتاحة</span>
                        <h3 class="text-2xl font-black text-amankGreen mt-1">{{ $availableFleet ?? '18 وحدة' }}</h3>
                        <p class="text-[10px] text-amankGreen mt-1 font-semibold">جاهزة للتوجيه السريع</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-50 text-amankGreen rounded-2xl flex items-center justify-center text-xl">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-card flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold text-slate-400">في مهام نشطة</span>
                        <h3 class="text-2xl font-black text-amankRed mt-1">{{ $activeMissions ?? '3 وحدات' }}</h3>
                        <p class="text-[10px] text-amankRed mt-1 font-semibold">متجهة لمواقع بلاغات</p>
                    </div>
                    <div class="w-12 h-12 bg-red-50 text-amankRed rounded-2xl flex items-center justify-center text-xl">
                        <i class="fa-solid fa-car-burst"></i>
                    </div>
                </div>

                <!-- Card 4 (Highlighted Active Style) -->
                <div class="bg-amankBlue text-white p-4 rounded-2xl shadow-glow-blue flex items-center justify-between relative overflow-hidden">
                    <div class="z-10">
                        <span class="text-xs font-bold text-blue-100">كفاءة تشغيل الأسطول</span>
                        <h3 class="text-2xl font-black mt-1">94%</h3>
                        <p class="text-[10px] text-blue-200 mt-1 font-medium">معدل استجابة قياسي</p>
                    </div>
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-xl backdrop-blur-sm z-10">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div class="absolute -left-4 -bottom-4 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
                </div>

            </div>

            <!-- ===== 2. SPLIT SECTION: LIVE MAP + FLEET TABLE ===== -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                
                <!-- A. MAP CONTAINER (1 Col) -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-card p-4 flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-extrabold text-slate-800">مواقع الأسطول الحية (GPS)</h3>
                        <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full font-bold">تحديث فوري</span>
                    </div>
                    <div id="fleetMap" class="w-full h-72 rounded-xl border border-slate-200"></div>
                </div>

                <!-- B. MASTER TABLE CONTAINER (2 Cols) -->
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-card overflow-hidden flex flex-col">
                    <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                        <h3 class="text-xs font-extrabold text-slate-800">حالة الوحدات والمركبات الميدانية</h3>
                        <button class="text-[11px] font-bold text-amankBlue hover:underline">عرض الكل ←</button>
                    </div>
                    
                    <div class="overflow-x-auto flex-1">
                        <table class="w-full text-right text-xs">
                            <thead class="bg-slate-50 text-slate-400 font-bold border-b border-slate-100">
                                <tr>
                                    <th class="p-3">كود الوحدة</th>
                                    <th class="p-3">نوع المركبة</th>
                                    <th class="p-3">القائد / المسؤول</th>
                                    <th class="p-3">المنطقة</th>
                                    <th class="p-3 text-center">الحالة</th>
                                    <th class="p-3 text-center">الإجراء</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                                
                                @forelse($fleets ?? [] as $fleet)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-3 font-extrabold text-amankBlue">{{ $fleet->code ?? '#AMB-101' }}</td>
                                    <td class="p-3 font-bold">{{ $fleet->type ?? 'سيارة إسعاف' }}</td>
                                    <td class="p-3">{{ $fleet->leader ?? 'م. خالد عبد الله' }}</td>
                                    <td class="p-3 text-slate-500">{{ $fleet->zone ?? 'مدينة نصر' }}</td>
                                    <td class="p-3 text-center">
                                        <span class="px-2.5 py-1 bg-emerald-50 text-amankGreen border border-emerald-200 rounded-full text-[10px] font-bold">
                                            {{ $fleet->status ?? 'متاحة' }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-center">
                                        <button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تتبع</button>
                                    </td>
                                </tr>
                                @empty
                                <!-- Static Fallback Rows -->
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-3 font-extrabold text-amankBlue">#AMB-101</td>
                                    <td class="p-3 font-bold">سيارة إسعاف</td>
                                    <td class="p-3">م. خالد عبد الله</td>
                                    <td class="p-3 text-slate-500">مدينة نصر</td>
                                    <td class="p-3 text-center"><span class="px-2.5 py-1 bg-emerald-50 text-amankGreen border border-emerald-200 rounded-full text-[10px] font-bold">متاحة</span></td>
                                    <td class="p-3 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تتبع</button></td>
                                </tr>
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-3 font-extrabold text-amankBlue">#AMB-102</td>
                                    <td class="p-3 font-bold">سيارة إسعاف</td>
                                    <td class="p-3">كابتن. أحمد سعيد</td>
                                    <td class="p-3 text-slate-500">المعادي</td>
                                    <td class="p-3 text-center"><span class="px-2.5 py-1 bg-red-50 text-amankRed border border-red-200 rounded-full text-[10px] font-bold">في مهمة</span></td>
                                    <td class="p-3 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تتبع</button></td>
                                </tr>
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-3 font-extrabold text-amankBlue">#FIRE-05</td>
                                    <td class="p-3 font-bold">سيارة إطفاء</td>
                                    <td class="p-3">ملازم. رامي حسن</td>
                                    <td class="p-3 text-slate-500">التجمع الخامس</td>
                                    <td class="p-3 text-center"><span class="px-2.5 py-1 bg-emerald-50 text-amankGreen border border-emerald-200 rounded-full text-[10px] font-bold">متاحة</span></td>
                                    <td class="p-3 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تتبع</button></td>
                                </tr>
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-3 font-extrabold text-amankBlue">#PATROL-42</td>
                                    <td class="p-3 font-bold">دورية مرور</td>
                                    <td class="p-3">عقيد. هاني ممدوح</td>
                                    <td class="p-3 text-slate-500">وسط البلد</td>
                                    <td class="p-3 text-center"><span class="px-2.5 py-1 bg-amber-50 text-amankAmber border border-amber-200 rounded-full text-[10px] font-bold">صيانة</span></td>
                                    <td class="p-3 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تتبع</button></td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <!-- Leaflet Map Script -->
    <script>
        window.onload = function() {
            const map = L.map('fleetMap', { zoomControl: false }).setView([30.0444, 31.2357], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19, attribution: '© AMANK Fleet'
            }).addTo(map);

            L.control.zoom({ position: 'bottomleft' }).addTo(map);

            function createIcon(colorClass, icon) {
                return L.divIcon({
                    className: 'custom-div-icon',
                    html: `<div class="custom-marker-pin ${colorClass}"><i class="fa-solid ${icon}"></i></div>`,
                    iconSize: [28, 38], iconAnchor: [14, 38]
                });
            }

            L.marker([30.0550, 31.2800], { icon: createIcon('marker-blue', 'fa-truck-medical') }).addTo(map);
            L.marker([30.0350, 31.2500], { icon: createIcon('marker-green', 'fa-shield-halved') }).addTo(map);
            L.marker([30.0100, 31.2100], { icon: createIcon('marker-red', 'fa-fire-extinguisher') }).addTo(map);
        };
    </script>
</body>
</html>