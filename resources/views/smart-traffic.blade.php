<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-[#F3F6FB]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أمانك | AMANK - Smart Traffic & IoT (المرور الذكي)</title>
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
        .marker-amber { background: #F59E0B; }
        .marker-green { background: #16A579; }
        .marker-red { background: #E53935; }
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
                    <h2 class="text-base font-extrabold text-slate-800">Smart Traffic & IoT (المرور الذكي)</h2>
                    <p class="text-[10px] text-slate-400 font-semibold">مراقبة الإشارات الضوئية وحساسات الطرق وتدفق الحركة المرورية لحظة بلحظة</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-amankAmber bg-amber-50 px-3 py-1.5 rounded-xl border border-amber-200 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-amankAmber animate-pulse"></span> متصل بنظام IoT المركزي
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
                        <span class="text-xs font-bold text-slate-400">إجمالي التقاطعات</span>
                        <h3 class="text-2xl font-black text-slate-800 mt-1">{{ $totalIntersections ?? '32 تقاطع' }}</h3>
                        <p class="text-[10px] text-amankBlue mt-1 font-semibold">تغطية المحاور الرئيسية</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 text-amankBlue rounded-2xl flex items-center justify-center text-xl">
                        <i class="fa-solid fa-traffic-light"></i>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-card flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold text-slate-400">حساسات IoT نشطة</span>
                        <h3 class="text-2xl font-black text-amankGreen mt-1">{{ $activeSensors ?? '128 حساس' }}</h3>
                        <p class="text-[10px] text-amankGreen mt-1 font-semibold">تعمل بكفاءة تامة</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-50 text-amankGreen rounded-2xl flex items-center justify-center text-xl">
                        <i class="fa-solid fa-tower-broadcast"></i>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-card flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold text-slate-400">تكدسات مرورية</span>
                        <h3 class="text-2xl font-black text-amankAmber mt-1">{{ $trafficCongestions ?? '2 تقاطعات' }}</h3>
                        <p class="text-[10px] text-amber-600 mt-1 font-semibold">جاري التعديل الآلي للأزمنة</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-50 text-amankAmber rounded-2xl flex items-center justify-center text-xl">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>

                <!-- Card 4 (Highlighted Active Style) -->
                <div class="bg-amankBlue text-white p-4 rounded-2xl shadow-glow-blue flex items-center justify-between relative overflow-hidden">
                    <div class="z-10">
                        <span class="text-xs font-bold text-blue-100">التحكم الذكي (AI)</span>
                        <h3 class="text-2xl font-black mt-1">مفعل</h3>
                        <p class="text-[10px] text-blue-200 mt-1 font-medium">إدارة التدفق بالذكاء الاصطناعي</p>
                    </div>
                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-xl backdrop-blur-sm z-10">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <div class="absolute -left-4 -bottom-4 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
                </div>

            </div>

            <!-- ===== 2. SPLIT SECTION: MAP + LIVE METRICS CARDS ===== -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                
                <!-- A. MAP CONTAINER (1 Col) -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-card p-4 flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-extrabold text-slate-800">خريطة المرور والتقاطعات الحية</h3>
                        <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full font-bold">تحديث حي</span>
                    </div>
                    <div id="smartTrafficMap" class="w-full h-72 rounded-xl border border-slate-200"></div>
                </div>

                <!-- B. LIVE METRICS CARDS (2 Cols) -->
                <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4 content-start">
                    
                    <!-- Sub-card 1 -->
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-card flex items-center justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400">تقاطع شارع النصر</span>
                            <h4 class="text-sm font-extrabold text-slate-800 mt-1">كثافة متوسطة (65%)</h4>
                            <span class="inline-block mt-2 px-2.5 py-0.5 bg-emerald-50 text-amankGreen rounded-full text-[10px] font-bold">الإشارة: أخضر (45 ثانية)</span>
                        </div>
                        <div class="w-12 h-12 bg-emerald-50 text-amankGreen rounded-2xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-traffic-light"></i>
                        </div>
                    </div>

                    <!-- Sub-card 2 -->
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-card flex items-center justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400">محور صلاح سالم</span>
                            <h4 class="text-sm font-extrabold text-slate-800 mt-1">كثافة عالية جداً (92%)</h4>
                            <span class="inline-block mt-2 px-2.5 py-0.5 bg-red-50 text-amankRed rounded-full text-[10px] font-bold">الإشارة: أحمر (تعديل تلقائي)</span>
                        </div>
                        <div class="w-12 h-12 bg-red-50 text-amankRed rounded-2xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-traffic-light"></i>
                        </div>
                    </div>

                    <!-- Sub-card 3 -->
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-card flex items-center justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400">ميدان التحرير</span>
                            <h4 class="text-sm font-extrabold text-slate-800 mt-1">كثافة منخفضة (30%)</h4>
                            <span class="inline-block mt-2 px-2.5 py-0.5 bg-emerald-50 text-amankGreen rounded-full text-[10px] font-bold">الإشارة: أخضر (60 ثانية)</span>
                        </div>
                        <div class="w-12 h-12 bg-emerald-50 text-amankGreen rounded-2xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-traffic-light"></i>
                        </div>
                    </div>

                    <!-- Sub-card 4 -->
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-card flex items-center justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400">دائري المعادي</span>
                            <h4 class="text-sm font-extrabold text-slate-800 mt-1">كثافة مرتفعة (78%)</h4>
                            <span class="inline-block mt-2 px-2.5 py-0.5 bg-amber-50 text-amankAmber rounded-full text-[10px] font-bold">الإشارة: أصفر متقطع</span>
                        </div>
                        <div class="w-12 h-12 bg-amber-50 text-amankAmber rounded-2xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-traffic-light"></i>
                        </div>
                    </div>

                </div>

            </div>

            <!-- ===== 3. MASTER TABLE CONTAINER ===== -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-card overflow-hidden">
                <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-xs font-extrabold text-slate-800">سجل تقاطعات وحساسات المرور الذكي</h3>
                    <button class="text-[11px] font-bold text-amankBlue hover:underline">عرض الكل ←</button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-right text-xs">
                        <thead class="bg-slate-50 text-slate-400 font-bold border-b border-slate-100">
                            <tr>
                                <th class="p-3">كود التقاطع</th>
                                <th class="p-3">اسم المحور المروري</th>
                                <th class="p-3">معدل الكثافة</th>
                                <th class="p-3">حالة الإشارة الضوئية</th>
                                <th class="p-3 text-center">اتصال IoT</th>
                                <th class="p-3 text-center">الإجراء</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                            @forelse($traffics ?? [] as $traffic)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3 font-extrabold text-amankBlue">{{ $traffic->code ?? '#TR-201' }}</td>
                                <td class="p-3 font-bold">{{ $traffic->name ?? 'تقاطع شارع النصر مع مكرم عبيد' }}</td>
                                <td class="p-3 text-amber-600 font-bold">{{ $traffic->density ?? 'متوسطة (65%)' }}</td>
                                <td class="p-3 text-amankGreen font-bold">{{ $traffic->signal ?? 'أخضر (45 ثانية)' }}</td>
                                <td class="p-3 text-center"><span class="px-2.5 py-1 bg-emerald-50 text-amankGreen border border-emerald-200 rounded-full text-[10px] font-bold">متصل</span></td>
                                <td class="p-3 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تحكم</button></td>
                            </tr>
                            @empty
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3 font-extrabold text-amankBlue">#TR-201</td>
                                <td class="p-3 font-bold">تقاطع شارع النصر مع مكرم عبيد</td>
                                <td class="p-3 text-amber-600 font-bold">متوسطة (65%)</td>
                                <td class="p-3 text-amankGreen font-bold">أخضر (45 ثانية)</td>
                                <td class="p-3 text-center"><span class="px-2.5 py-1 bg-emerald-50 text-amankGreen border border-emerald-200 rounded-full text-[10px] font-bold">متصل</span></td>
                                <td class="p-3 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تحكم</button></td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3 font-extrabold text-amankBlue">#TR-202</td>
                                <td class="p-3 font-bold">محور العروبة - صلاح سالم</td>
                                <td class="p-3 text-amankRed font-bold">عالية جداً (92%)</td>
                                <td class="p-3 text-amankRed font-bold">أحمر (تعديل تلقائي)</td>
                                <td class="p-3 text-center"><span class="px-2.5 py-1 bg-emerald-50 text-amankGreen border border-emerald-200 rounded-full text-[10px] font-bold">متصل</span></td>
                                <td class="p-3 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تحكم</button></td>
                            </tr>
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3 font-extrabold text-amankBlue">#TR-203</td>
                                <td class="p-3 font-bold">ميدان التحرير - وسط البلد</td>
                                <td class="p-3 text-slate-600 font-bold">منخفضة (30%)</td>
                                <td class="p-3 text-amankGreen font-bold">أخضر (60 ثانية)</td>
                                <td class="p-3 text-center"><span class="px-2.5 py-1 bg-emerald-50 text-amankGreen border border-emerald-200 rounded-full text-[10px] font-bold">متصل</span></td>
                                <td class="p-3 text-center"><button class="px-2.5 py-1 bg-slate-100 hover:bg-amankBlue hover:text-white rounded-lg font-bold transition">تحكم</button></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- Leaflet Map Script -->
    <script>
        window.onload = function() {
            const map = L.map('smartTrafficMap', { zoomControl: false }).setView([30.0444, 31.2357], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19, attribution: '© AMANK Smart Traffic'
            }).addTo(map);

            L.control.zoom({ position: 'bottomleft' }).addTo(map);

            function createIcon(colorClass, icon) {
                return L.divIcon({
                    className: 'custom-div-icon',
                    html: `<div class="custom-marker-pin ${colorClass}"><i class="fa-solid ${icon}"></i></div>`,
                    iconSize: [28, 38], iconAnchor: [14, 38]
                });
            }

            L.marker([30.0550, 31.2800], { icon: createIcon('marker-amber', 'fa-traffic-light') }).addTo(map);
            L.marker([30.0350, 31.2500], { icon: createIcon('marker-green', 'fa-traffic-light') }).addTo(map);
            L.marker([30.0100, 31.2100], { icon: createIcon('marker-red', 'fa-triangle-exclamation') }).addTo(map);
        };
    </script>
</body>
</html>