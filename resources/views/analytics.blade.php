<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-[#F3F6FB]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>أمانك | AMANK - Analytics & Reports (التحليلات والتقارير)</title>
    <!-- سطر مكتبة Alpine.js للتفاعل -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome 6 Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Cairo Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Chart.js CDN for Analytics Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

    <!-- ===== SHARED SIDEBAR ===== -->
    @include('sidebar')

    <!-- ===== MAIN CONTENT CONTAINER ===== -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <!-- ===== TOP NAVBAR ===== -->
        <header class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between shrink-0 z-10 shadow-sm">
            <div class="flex items-center gap-3">
                <div>
                    <h2 class="text-base font-extrabold text-slate-800">التحليلات والتقارير الشاملة (Analytics & Reports)</h2>
                    <p class="text-[10px] text-slate-400 font-semibold">تحليل مؤشرات الأداء، أوقات الاستجابة، وتوزيع البلاغات الذكية</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button class="bg-amankBlue text-white px-4 py-2 rounded-xl text-xs font-bold shadow-md hover:bg-blue-700 transition flex items-center gap-2">
                    <i class="fa-solid fa-file-export"></i> تصدير التقرير (PDF/Excel)
                </button>
            </div>
        </header>

        <!-- ===== MAIN BODY CONTAINER ===== -->
        <main class="flex-1 overflow-y-auto p-5 space-y-5">
            
            <!-- ===== FILTERS & DATE RANGE BAR ===== -->
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-card flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-2 text-xs font-bold text-slate-600">
                    <span class="text-slate-400">الفترة الزمنية:</span>
                    <button class="px-3 py-1.5 bg-amankBlue text-white rounded-xl shadow-sm">هذا الشهر</button>
                    <button class="px-3 py-1.5 bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-xl transition">الأسبوع الحالي</button>
                    <button class="px-3 py-1.5 bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-xl transition">السنة الحالية</button>
                </div>
                <div class="flex items-center gap-3">
                    <select class="bg-slate-50 border border-slate-200 text-xs rounded-xl px-3 py-2 focus:outline-none font-semibold">
                        <option>جميع القطاعات الجغرافية</option>
                        <option>قطاع القاهرة الكبرى</option>
                        <option>قطاع الدلتا والمحيط</option>
                    </select>
                </div>
            </div>

            <!-- ===== 2-COLUMN GRID CHARTS ===== -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                
                <!-- Left Column Charts -->
                <div class="space-y-5">
                    
                    <!-- 1. Bar Chart: Incidents Trend -->
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-card">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-xs font-extrabold text-slate-800">معدل البلاغات والحوادث الشهرية</h3>
                                <p class="text-[10px] text-slate-400">مقارنة بين إجمالي البلاغات والاستجابة السريعة</p>
                            </div>
                            <span class="text-xs font-bold text-amankGreen bg-emerald-50 px-2.5 py-1 rounded-full">+12.4% كفاءة</span>
                        </div>
                        <div class="h-64">
                            <canvas id="incidentsBarChart"></canvas>
                        </div>
                    </div>

                    <!-- 2. Area Chart: Response Time Timeline -->
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-card">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-xs font-extrabold text-slate-800">مؤشر متوسط زمن الاستجابة (بالدقائق)</h3>
                                <p class="text-[10px] text-slate-400">تحسن سرعة وصول وحدات الطوارئ للحادث</p>
                            </div>
                            <span class="text-xs font-bold text-amankBlue bg-blue-50 px-2.5 py-1 rounded-full">متوسط 7.2 دقيقة</span>
                        </div>
                        <div class="h-52">
                            <canvas id="responseTimeAreaChart"></canvas>
                        </div>
                    </div>

                </div>

                <!-- Right Column Charts -->
                <div class="space-y-5">
                    
                    <!-- 3. Donut Chart: Incidents Distribution -->
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-card">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-xs font-extrabold text-slate-800">توزيع البلاغات حسب النوع</h3>
                                <p class="text-[10px] text-slate-400">نسبة حوادث الطرق، الطوارئ الطبية، الحرائق، والأعطال</p>
                            </div>
                        </div>
                        <div class="h-64 flex items-center justify-center">
                            <canvas id="incidentsDonutChart"></canvas>
                        </div>
                    </div>

                    <!-- 4. Regional Breakdown Card / Heatmap Summary -->
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-card space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-extrabold text-slate-800">أكثر المناطق تسجيل للبلاغات (Heatmap Breakdown)</h3>
                            <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full font-bold">تحديث شهري</span>
                        </div>
                        
                        <div class="space-y-3 text-xs">
                            <div>
                                <div class="flex justify-between font-bold mb-1">
                                    <span class="text-slate-700">طريق القاهرة - الإسكندرية الصحراوي</span>
                                    <span class="text-amankRed">34% من البلاغات</span>
                                </div>
                                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-amankRed rounded-full" style="width: 34%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between font-bold mb-1">
                                    <span class="text-slate-700">محور الطريق الدائري (نزلة المنيب)</span>
                                    <span class="text-amankAmber">28% من البلاغات</span>
                                </div>
                                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-amankAmber rounded-full" style="width: 28%"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between font-bold mb-1">
                                    <span class="text-slate-700">شارع النصر - مدينة نصر</span>
                                    <span class="text-amankBlue">22% من البلاغات</span>
                                </div>
                                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-amankBlue rounded-full" style="width: 22%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </main>
    </div>

    <!-- Chart.js Scripts -->
    <script>
        window.onload = function() {
            // 1. Bar Chart
            const ctxBar = document.getElementById('incidentsBarChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس'],
                    datasets: [{
                        label: 'عدد البلاغات',
                        data: [65, 59, 80, 81, 56, 72, 90, 85],
                        backgroundColor: '#1769FF',
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { grid: { color: '#f1f5f9' } }
                    }
                }
            });

            // 2. Area Chart
            const ctxArea = document.getElementById('responseTimeAreaChart').getContext('2d');
            new Chart(ctxArea, {
                type: 'line',
                data: {
                    labels: ['الأسبوع 1', 'الأسبوع 2', 'الأسبوع 3', 'الأسبوع 4'],
                    datasets: [{
                        label: 'زمن الاستجابة (دقائق)',
                        data: [12, 9.5, 8, 7.2],
                        borderColor: '#16A579',
                        backgroundColor: 'rgba(22, 165, 121, 0.15)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { grid: { color: '#f1f5f9' } }
                    }
                }
            });

            // 3. Donut Chart
            const ctxDonut = document.getElementById('incidentsDonutChart').getContext('2d');
            new Chart(ctxDonut, {
                type: 'doughnut',
                data: {
                    labels: ['حوادث طرق', 'طوارئ طبية', 'حرائق', 'أعطال وحثيات'],
                    datasets: [{
                        data: [45, 25, 15, 15],
                        backgroundColor: ['#E53935', '#1769FF', '#F59E0B', '#16A579'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'right', labels: { font: { family: 'Cairo', size: 11 } } }
                    },
                    cutout: '70%'
                }
            });
        };
    </script>
</body>
</html>