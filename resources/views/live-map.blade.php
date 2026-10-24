<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-[#F3F6FB]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أمانك | AMANK - Live Map (الخريطة المباشرة)</title>
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
    </style>
</head>
<body class="h-full flex overflow-hidden text-slate-800 antialiased">

    <!-- ===== 1. RIGHT MAIN SIDEBAR ===== -->
    <aside class="w-64 bg-amankDark text-white flex flex-col justify-between shrink-0 z-30 shadow-xl transition-all duration-300" dir="rtl">
        <div>
            <!-- Header / Logo -->
            <div class="h-16 flex items-center px-6 gap-3 border-b border-slate-800/80">
                <div class="w-9 h-9 bg-amankRed rounded-xl flex items-center justify-center text-white text-lg shadow-lg shadow-red-900/50">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h1 class="text-lg font-extrabold tracking-wider text-white">AMANK <span class="text-xs font-semibold text-amankBlue">أمانك</span></h1>
                    <p class="text-[9px] text-slate-400 font-medium">نظام الطوارئ والمرور الذكي</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-4 px-3 space-y-1">
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3.5 px-4 py-2.5 {{ request()->is('admin/dashboard') ? 'bg-amankBlue text-white font-bold shadow-glow-blue' : 'text-slate-400 hover:bg-amankSidebarHover hover:text-white' }} rounded-xl transition">
                    <i class="fa-solid fa-chart-pie w-5 text-center text-base"></i>
                    <span class="text-xs">الصفحة الرئيسية</span>
                </a>

                <a href="{{ url('/admin/live-map') }}" class="flex items-center gap-3.5 px-4 py-2.5 {{ request()->is('admin/live-map') ? 'bg-amankBlue text-white font-bold shadow-glow-blue' : 'text-slate-400 hover:bg-amankSidebarHover hover:text-white' }} rounded-xl transition">
                    <i class="fa-solid fa-map-location-dot w-5 text-center text-base"></i>
                    <span class="text-xs">الخريطة المباشرة</span>
                </a>

                <a href="{{ url('/admin/incidents') }}" class="flex items-center gap-3.5 px-4 py-2.5 {{ request()->is('admin/incidents') ? 'bg-amankBlue text-white font-bold shadow-glow-blue' : 'text-slate-400 hover:bg-amankSidebarHover hover:text-white' }} rounded-xl transition">
                    <i class="fa-solid fa-triangle-exclamation w-5 text-center text-base"></i>
                    <span class="text-xs">إدارة البلاغات</span>
                    <span class="mr-auto bg-amankRed/20 text-amankRed text-[10px] font-bold px-2 py-0.5 rounded-full">8</span>
                </a>

                <a href="{{ url('/admin/fleet') }}" class="flex items-center gap-3.5 px-4 py-2.5 {{ request()->is('admin/fleet') ? 'bg-amankBlue text-white font-bold shadow-glow-blue' : 'text-slate-400 hover:bg-amankSidebarHover hover:text-white' }} rounded-xl transition">
                    <i class="fa-solid fa-truck-medical w-5 text-center text-base"></i>
                    <span class="text-xs">أسطول الطوارئ</span>
                </a>

                <a href="{{ url('/admin/smart-traffic') }}" class="flex items-center gap-3.5 px-4 py-2.5 {{ request()->is('admin/smart-traffic') ? 'bg-amankBlue text-white font-bold shadow-glow-blue' : 'text-slate-400 hover:bg-amankSidebarHover hover:text-white' }} rounded-xl transition group">
                    <i class="fa-solid fa-traffic-light w-5 text-center text-base group-hover:text-amankAmber transition"></i>
                    <span class="text-xs">المرور الذكي و IoT</span>
                </a>

                <a href="{{ url('/admin/analytics') }}" class="flex items-center gap-3.5 px-4 py-2.5 {{ request()->is('admin/analytics') ? 'bg-amankBlue text-white font-bold shadow-glow-blue' : 'text-slate-400 hover:bg-amankSidebarHover hover:text-white' }} rounded-xl transition group">
                    <i class="fa-solid fa-chart-line w-5 text-center text-base group-hover:text-amankBlue transition"></i>
                    <span class="text-xs">التحليلات والتقارير</span>
                </a>

                <a href="{{ url('/admin/settings') }}" class="flex items-center gap-3.5 px-4 py-2.5 {{ request()->is('admin/settings') ? 'bg-amankBlue text-white font-bold shadow-glow-blue' : 'text-slate-400 hover:bg-amankSidebarHover hover:text-white' }} rounded-xl transition group">
                    <i class="fa-solid fa-sliders w-5 text-center text-base group-hover:text-slate-200 transition"></i>
                    <span class="text-xs">الإعدادات والصلاحيات</span>
                </a>
            </nav>
        </div>

        <div class="p-3 border-t border-slate-800/80 bg-slate-900/40">
            <div class="flex items-center gap-2.5">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="User" class="w-9 h-9 rounded-xl object-cover ring-2 ring-amankBlue">
                <div class="overflow-hidden">
                    <h4 class="text-xs font-bold text-white truncate">م. صبحي يوسف</h4>
                    <p class="text-[9px] text-slate-400 truncate">مدير غرفة العمليات</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- ===== MAIN LIVE MAP VIEW LAYOUT ===== -->
    <div class="flex-1 flex min-w-0 overflow-hidden relative">

        <!-- ===== 2. MAP FILTER & INCIDENT LIST SIDEBAR (يمين الخريطة) ===== -->
        <div class="w-60 bg-white border-l border-slate-200 flex flex-col shrink-0 z-20 shadow-sm" dir="rtl">
            <div class="p-4 border-b border-slate-100">
                <div class="relative">
                    <input type="text" placeholder="بحث عن بلاغ أو وحدة..." class="w-full bg-slate-50 border border-slate-200 text-xs rounded-xl pr-8 pl-3 py-2 focus:outline-none focus:border-amankBlue">
                    <i class="fa-solid fa-magnifying-glass absolute right-2.5 top-2.5 text-slate-400 text-xs"></i>
                </div>
                
                <h3 class="text-xs font-extrabold text-slate-800 mt-4 mb-2">تصفية التغطية</h3>
                <div class="space-y-1.5 text-xs font-semibold text-slate-600">
                    <label class="flex items-center justify-between p-2 rounded-lg bg-slate-50 cursor-pointer hover:bg-slate-100">
                        <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-amankRed"></span> الحوادث العاجلة</span>
                        <input type="checkbox" checked class="rounded text-amankBlue">
                    </label>
                    <label class="flex items-center justify-between p-2 rounded-lg bg-slate-50 cursor-pointer hover:bg-slate-100">
                        <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-amankBlue"></span> أسطول الإسعاف</span>
                        <input type="checkbox" checked class="rounded text-amankBlue">
                    </label>
                    <label class="flex items-center justify-between p-2 rounded-lg bg-slate-50 cursor-pointer hover:bg-slate-100">
                        <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-amankAmber"></span> دوريات المرور</span>
                        <input type="checkbox" checked class="rounded text-amankBlue">
                    </label>
                    <label class="flex items-center justify-between p-2 rounded-lg bg-slate-50 cursor-pointer hover:bg-slate-100">
                        <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-amankGreen"></span> الحماية المدنية</span>
                        <input type="checkbox" checked class="rounded text-amankBlue">
                    </label>
                </div>
            </div>

            <!-- Active List from Database -->
            <div class="flex-1 overflow-y-auto p-3 space-y-2">
                <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-1">البلاغات المباشرة ({{ count($incidents ?? []) }})</h4>
                
                @forelse($incidents ?? [] as $incident)
                <div class="p-2.5 @if($loop->first) bg-red-50 border-red-100 @else bg-blue-50 border-blue-100 @endif border rounded-xl cursor-pointer hover:shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-extrabold @if($loop->first) text-amankRed @else text-amankBlue @endif">#EMG-{{ $incident->id ?? 8091 }}</span>
                        <span class="text-[9px] @if($loop->first) bg-amankRed @else bg-amankBlue @endif text-white px-1.5 py-0.5 rounded font-bold">
                            @if(($incident->status ?? 'active') == 'active') نشط @else مكتمل @endif
                        </span>
                    </div>
                    <p class="text-xs text-slate-700 font-bold mt-1">{{ $incident->title ?? 'حادث سير عاجل' }}</p>
                    <p class="text-[10px] text-slate-500">{{ $incident->location ?? 'شارع النصر - مدينة نصر' }}</p>
                </div>
                @empty
                <div class="text-center p-4 text-xs text-slate-400 font-bold">لا توجد بلاغات مسجلة</div>
                @endforelse
            </div>
        </div>

        <!-- ===== 3. CENTER MAP CANVAS ===== -->
        <div class="flex-1 relative h-full">
            <div id="fullLiveMap" class="w-full h-full z-10"></div>
            
            <!-- Floating Top Toolbar on Map -->
            <div class="absolute top-4 right-4 z-20 bg-white/90 backdrop-blur border border-slate-200 px-4 py-2 rounded-xl shadow-lg flex items-center gap-3 text-xs font-bold text-slate-700" dir="rtl">
                <span class="flex items-center gap-1.5 text-amankGreen"><span class="w-2.5 h-2.5 rounded-full bg-amankGreen animate-ping"></span> التتبع الحي مفعل</span>
                <span class="text-slate-300">|</span>
                <span>تحديث GPS متصل بقاعدة البيانات</span>
            </div>
        </div>

        <!-- ===== 4. LEFT INCIDENT DETAILS HUD PANEL (يسار الخريطة) ===== -->
        <div class="w-80 bg-white border-r border-slate-200 flex flex-col shrink-0 z-20 shadow-xl overflow-y-auto" dir="rtl">
            <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold text-amankRed bg-red-100 px-2 py-0.5 rounded-full">بلاغ حرج حالي</span>
                    <h3 class="text-base font-black text-slate-800 mt-1">إدارة الخريطة الحية</h3>
                </div>
            </div>

            <div class="p-4 space-y-4 text-xs">
                <!-- Incident Image / Snapshot -->
                <div class="rounded-xl overflow-hidden border border-slate-200 relative">
                    <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=500&auto=format&fit=crop&q=80" alt="Incident Location" class="w-full h-32 object-cover">
                    <span class="absolute bottom-2 right-2 bg-black/60 backdrop-blur text-white text-[10px] px-2 py-0.5 rounded font-bold">صورة ملتقطة من الكاميرا الحية</span>
                </div>

                <!-- Info Grid -->
                <div class="space-y-2 bg-slate-50 p-3 rounded-xl border border-slate-100 font-semibold">
                    <div class="flex justify-between text-slate-600">
                        <span>إجمالي البلاغات على الخريطة:</span>
                        <span class="font-bold text-slate-800">{{ count($incidents ?? []) }} بلاغات</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>حالة الخريطة:</span>
                        <span class="font-bold text-amankGreen">متصل بالـ DB بنجاح</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="space-y-2 pt-2">
                    <button class="w-full bg-amankBlue text-white py-2.5 rounded-xl font-bold shadow-md hover:bg-blue-700 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-phone"></i> الاتصال بالطاقم الميداني
                    </button>
                    <button class="w-full bg-emerald-600 text-white py-2.5 rounded-xl font-bold shadow-md hover:bg-emerald-700 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-circle-check"></i> تأكيد وصول الخدمة والإنهاء
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Map Script with Database Integration -->
    <script>
        window.onload = function() {
            // إحداثيات مركز مصر/القاهرة الافتراضية
            const map = L.map('fullLiveMap', { zoomControl: false }).setView([30.0444, 31.2357], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19, attribution: '© AMANK System'
            }).addTo(map);

            L.control.zoom({ position: 'bottomleft' }).addTo(map);

            function createIcon(colorClass, icon) {
                return L.divIcon({
                    className: 'custom-div-icon',
                    html: `<div class="custom-marker-pin ${colorClass}"><i class="fa-solid ${icon}"></i></div>`,
                    iconSize: [30, 42], iconAnchor: [15, 42]
                });
            }

            // سحب البلاغات الحقيقية من قاعدة البيانات عبر Laravel Blade وتحويلها لـ JavaScript
            const incidents = @json($incidents ?? []);

            incidents.forEach(function(incident) {
                if(incident.lat && incident.lng) {
                    let iconClass = incident.status === 'active' ? 'marker-red' : 'marker-green';
                    let iconName = 'fa-triangle-exclamation';
                    
                    let marker = L.marker([incident.lat, incident.lng], { 
                        icon: createIcon(iconClass, iconName) 
                    }).addTo(map);

                    marker.bindPopup(`
                        <div dir="rtl" style="font-family: 'Cairo', sans-serif; text-align: right; min-width: 160px;">
                            <b style="color: #1769FF; font-size: 13px;">#EMG-${incident.id} - ${incident.title}</b><br>
                            <span style="font-size: 11px; color: #555;">النوع: ${incident.type}</span><br>
                            <span style="font-size: 11px; color: #555;">الموقع: ${incident.location}</span><br>
                            <span style="font-size: 10px; font-weight: bold; color: ${incident.status === 'active' ? '#E53935' : '#16A579'};">
                                الحالة: ${incident.status === 'active' ? 'نشط' : 'مكتمل'}
                            </span>
                        </div>
                    `);
                }
            });
        };

        function fetchLatestIncidents() {
            fetch('/api/incidents') // مسار الـ API اللي عملناه في لارافيل
                .then(response => response.json())
                .then(result => {
                    if (result.status && result.data) {
                        console.log('تم تحديث البيانات من قاعدة البيانات بنجاح:', result.data);
                    }
                })
                .catch(error => console.error('خطأ في جلب التحديثات:', error));
        }

        // تشغيل التحديث التلقائي كل 5 ثواني
        setInterval(fetchLatestIncidents, 5000);
    </script>
</body>
</html>