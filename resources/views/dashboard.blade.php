<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Dashboard
            </h2>
        </div>
    </x-slot>

    <div>
        <div class="container px-4 mx-auto">
            <div class="flex flex-wrap bg-white rounded-lg shadow divide-y xl:divide-x xl:divide-y-0">
                <div class="w-full p-2 xl:w-1/4 sm:w-1/2">
                    <div class="flex flex-row items-center px-4 py-4">

                        <span class="p-4 bg-blue-100 rounded-full">
                            <svg id='Election_5_32' class="text-blue-600" width='32' height='32'
                                viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'
                                xmlns:xlink='http://www.w3.org/1999/xlink'>
                                <rect width='32' height='32' stroke='none' fill='#000000' opacity='0' />

                                <g transform="matrix(1.17 0 0 1.17 16 16)">
                                    <path
                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                        transform=" translate(-12.32, -12.01)"
                                        d="M 21.31 7.89 L 17.78 5.54 L 19 1.28 C 19.09866633747167 0.9255529818212774 18.994728668016748 0.5455546335506969 18.729396801422848 0.29066890343687124 C 18.464064934828947 0.03578317332304559 18.080200387230196 -0.05281588376502189 17.73 0.05999999999999983 L 9.37 3.13 C 9.028728463855249 3.2571470771180935 8.783563296777368 3.559772830229851 8.729999999999999 3.92 L 8.729999999999999 3.92 C 8.685703833641929 4.080330041975136 8.685703833641929 4.249669958024864 8.729999999999999 4.41 L 8.729999999999999 4.41 L 11.48 12 C 11.476555551814188 12.053277719786593 11.476555551814188 12.106722280213408 11.48 12.16 L 11.540000000000001 12.290000000000001 L 12.41 14.71 L 11.53 15.040000000000001 L 11.03 13.850000000000001 C 10.968573456555465 13.705247486845726 10.84262960296708 13.59782478819681 10.69 13.560000000000002 C 10.541985958934006 13.519236927307645 10.383450114631707 13.548731968108074 10.26 13.640000000000002 L 8.06 15.35 C 7.865203581321604 15.559481334747263 7.742555663398095 15.825802527952597 7.710000000000001 16.11 L 7.48 18.24 C 7.4740110747223225 18.32732821072895 7.430180032914771 18.40768512070946 7.36 18.459999999999997 L 3 21.66 C 2.869043231168103 21.751184366311385 2.7906912495477494 21.900426236064437 2.79 22.06 L 2.79 23.5 C 2.79 23.7761423749154 3.0138576250846034 24 3.29 24 L 11.29 24 C 11.34626758584107 24.009510957915378 11.403732414158927 24.009510957915378 11.459999999999999 24 L 17.599999999999998 21.84 C 17.760183354258807 21.78110208313014 17.880288393056134 21.645983914483143 17.919999999999998 21.48 L 18.169999999999998 20.43 C 18.26876113532319 20.030268060438893 18.17231335027062 19.607381618285327 17.909999999999997 19.29 L 17.599999999999998 18.9 C 17.537025703794928 18.821321507891305 17.514794146081865 18.717574238563664 17.54 18.619999999999997 L 17.66 18.089999999999996 C 17.780912570057726 17.56722055339832 17.575839709967376 17.022988732389315 17.14 16.709999999999997 L 16.830000000000002 16.479999999999997 C 16.720149881285213 16.4047508335885 16.668375996933033 16.269342212975108 16.700000000000003 16.139999999999997 L 16.790000000000003 15.759999999999996 C 16.910303910233452 15.239462824670595 16.709902447489274 14.697200043127522 16.28 14.379999999999995 L 15.870000000000001 14.089999999999996 C 15.510147796543114 13.831923625259202 15.046031930383737 13.768294837156706 14.63 13.919999999999996 L 14.41 13.999999999999996 L 13.84 12.389999999999997 L 21.189999999999998 9.689999999999998 C 21.54379395158526 9.560876684572188 21.79503484725099 9.243926631578498 21.839999999999996 8.869999999999997 C 21.87852550528006 8.46605801247962 21.66913398652539 8.078881241952121 21.31 7.89 Z"
                                        stroke-linecap="round" />
                                </g>
                            </svg>
                        </span>

                        <div class="ml-4">
                            <div class="text-3xl font-bold text-gray-700">
                                {{ $stats['elections'] }}
                            </div>

                            <div class="text-sm text-gray-500">
                                Eleições Cadastradas
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Total de Chapas --}}
                <div class="w-full p-2 xl:w-1/4 sm:w-1/2">
                    <div class="flex flex-row items-center px-4 py-4">
                        <span class="p-4 bg-green-100 rounded-full">
                            <svg id='Election_Campaign_2_32' class="text-green-600" width='32' height='32'
                                viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'
                                xmlns:xlink='http://www.w3.org/1999/xlink'>
                                <rect width='32' height='32' stroke='none' fill='#000000' opacity='0' />

                                <g transform="matrix(1.17 0 0 1.17 16 16)">
                                    <g style="">
                                        <g transform="matrix(1 0 0 1 -7 2.5)">
                                            <circle
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                                cx="0" cy="0" r="3.5" />
                                        </g>
                                        <g transform="matrix(1 0 0 1 -7 9.25)">
                                            <path
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                                transform=" translate(-5, -21.25)"
                                                d="M 5 18.5 C 2.238576250846033 18.5 0 20.738576250846034 0 23.5 C 0 23.7761423749154 0.22385762508460327 24 0.5 24 L 9.5 24 C 9.776142374915397 24 10 23.7761423749154 10 23.5 C 10 20.738576250846034 7.761423749153967 18.5 5 18.5 Z"
                                                stroke-linecap="round" />
                                        </g>
                                        <g transform="matrix(1 0 0 1 1.02 3.69)">
                                            <circle
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                                cx="0" cy="0" r="3.02" />
                                        </g>
                                        <g transform="matrix(1 0 0 1 1.85 9.61)">
                                            <path
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                                transform=" translate(-13.85, -21.61)"
                                                d="M 13 19.22 C 12.152984311942307 19.219784301414958 11.324859204333675 19.470309544052864 10.620000000000001 19.939999999999998 C 10.499443574035858 20.028321643863105 10.42001899580727 20.161899343611182 10.4 20.31 C 10.386186037358327 20.459258013597005 10.441449964411666 20.606628485739243 10.55 20.709999999999997 C 11.172020435713636 21.502004963228703 11.48160809171722 22.49482054972296 11.42 23.499999999999993 C 11.42 23.776142374915395 11.643857625084603 23.999999999999996 11.92 23.999999999999996 L 16.8 23.999999999999996 C 17.0761423749154 23.999999999999996 17.3 23.776142374915395 17.3 23.499999999999996 C 17.300012431288273 22.361399689167776 16.846340762111943 21.269723004154745 16.039354235669233 20.466489903416424 C 15.232367709226526 19.6632568026781 14.13858787961181 19.214679437731668 13 19.22 Z"
                                                stroke-linecap="round" />
                                        </g>
                                        <g transform="matrix(1 0 0 1 8.38 5.82)">
                                            <path
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                                transform=" translate(-20.38, -17.82)"
                                                d="M 20.38 20.05 C 21.61159499212267 20.05 22.61 19.05159499212267 22.61 17.82 C 22.61 16.58840500787733 21.61159499212267 15.59 20.38 15.59 C 19.14840500787733 15.59 18.15 16.58840500787733 18.15 17.82 C 18.15 19.05159499212267 19.14840500787733 20.05 20.38 20.05 Z"
                                                stroke-linecap="round" />
                                        </g>
                                        <g transform="matrix(1 0 0 1 8.97 10.2)">
                                            <path
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                                transform=" translate(-20.97, -22.2)"
                                                d="M 20.38 20.41 C 19.76772551743985 20.40852008441835 19.168903164063806 20.58955940055529 18.659999999999997 20.93 C 18.42997441239039 21.09688720001137 18.37653380631892 21.417530836440182 18.54 21.65 C 18.877131115603394 22.205858436437552 19.037539759575747 22.850980156761143 19 23.499999999999996 C 19 23.7761423749154 19.2238576250846 24 19.5 24 L 23 24 C 23.2761423749154 24 23.5 23.7761423749154 23.5 23.5 C 23.500038870911197 22.675256631720362 23.170371316591265 21.88472222272449 22.584379222772085 21.30436466826896 C 21.99838712895291 20.72400711381343 21.20470449828445 20.40199278190733 20.38 20.41 Z"
                                                stroke-linecap="round" />
                                        </g>
                                        <g transform="matrix(1 0 0 1 4.05 -6.14)">
                                            <path
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                                transform=" translate(-16.05, -5.86)"
                                                d="M 9.3 11.75 L 9.370000000000001 11.75 C 9.892493708650816 11.75167445689939 10.328202971753747 11.350821934844696 10.370000000000001 10.83 L 10.540000000000001 8.59 L 22.270000000000003 9.52 L 22.35 9.52 C 22.72002958318895 9.52469511968811 23.062401288690484 9.324657718720921 23.24 9 C 23.421347336212243 8.634082356957675 23.36196581620869 8.194659108931388 23.09 7.89 L 21.09 5.699999999999999 L 23.35 3.849999999999999 C 23.664451036955203 3.59167224022797 23.790991225955196 3.1685534832592497 23.67 2.7799999999999994 C 23.548055690780423 2.3882253542135112 23.199164287528475 2.1106981016267334 22.790000000000003 2.079999999999999 L 11.09 1.11 L 11.09 1.11 C 11.142146786435124 0.7364014086048343 10.97962373637497 0.3652494874218717 10.669711511257756 0.15019226817346 C 10.359799286140541 -0.06486495107495172 9.955240998413412 -0.0872274694920292 9.623514117755409 0.09236226149745086 C 9.291787237097408 0.2719519924869309 9.089347452410989 0.6229300886336511 9.1 1.0000000000000002 L 9 1.94 L 9 2 L 8.62 7.44 L 8.62 7.44 L 8.379999999999999 10.67 C 8.357912387041594 10.93540805017448 8.44260857628433 11.198662576819842 8.615311758271984 11.401401094805347 C 8.788014940259638 11.604139612790853 9.034456024715116 11.729611450921658 9.3 11.75 Z"
                                                stroke-linecap="round" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>

                        <div class="ml-4">
                            <div class="text-3xl font-bold text-gray-700">
                                {{ $stats['candidates'] }}
                            </div>

                            <div class="text-sm text-gray-500">
                                Chapas Cadastradas
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Total de Votos --}}
                <div class="w-full p-2 xl:w-1/4 sm:w-1/2">
                    <div class="flex flex-row items-center px-4 py-4">

                        <span class="p-4 bg-indigo-100 rounded-full">
                            <svg id='Election_Ballot_Box_3_32' class="text-yellow-600" width='32' height='32'
                                viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'
                                xmlns:xlink='http://www.w3.org/1999/xlink'>
                                <rect width='32' height='32' stroke='none' fill='#000000' opacity='0' />

                                <g transform="matrix(1.17 0 0 1.17 16 16)">
                                    <g style="">
                                        <g transform="matrix(1 0 0 1 0 8.33)">
                                            <rect
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                                x="-9.62" y="-3.64" rx="0" ry="0" width="19.24"
                                                height="7.28" />
                                        </g>
                                        <g transform="matrix(1 0 0 1 0 1.77)">
                                            <rect
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                                x="-11.7" y="-1.56" rx="1.04" ry="1.04" width="23.4"
                                                height="3.12" />
                                        </g>
                                        <g transform="matrix(1 0 0 1 5.02 -7.84)">
                                            <path
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                                transform=" translate(-17.02, -4.16)"
                                                d="M 15.9 4.65 L 15.9 5.140000000000001 L 13.7 5.870000000000001 C 13.239999999999998 6.040000000000001 12.329999999999998 6.730000000000001 12.7 7.490000000000001 C 12.982433349927335 8.025093477586793 13.557006801705024 8.339928245684156 14.16 8.290000000000001 L 17 8 C 17.86 7.92 18.95 8 19.62 7.47 L 21.59 5.9 L 23.7 7.05 L 23.7 2.15 L 21.28 0.83 C 20.765528480483944 0.5526349827386319 20.20145641946456 0.3793357350760515 19.62 0.32000000000000106 L 16.78 0.05 C 15.679495861890327 -0.050857593018465486 14.581859426118573 0.27092507544882377 13.709999999999999 0.9500000000000013 L 10.34 3.61 L 14.86 3.61 C 15.139166592072675 3.5985909794110107 15.410375467849939 3.7044937895337187 15.60794083915811 3.9020591608418895 C 15.805506210466282 4.099624532150061 15.911409020588989 4.370833407927326 15.9 4.65 Z"
                                                stroke-linecap="round" />
                                        </g>
                                        <g transform="matrix(1 0 0 1 -0.99 -4.19)">
                                            <path
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: currentColor; fill-rule: nonzero; opacity: 1;"
                                                transform=" translate(-11.01, -7.81)"
                                                d="M 14.87 9.23 L 14.28 9.23 L 14.059999999999999 9.23 C 13.15444211807516 9.252509851572118 12.308095931294051 8.781466498748243 11.85 8 C 11.601028770657143 7.533932940344555 11.568152431495228 6.98234102773908 11.76 6.490000000000002 C 12.071313343807915 5.778605072825464 12.660344824842038 5.225710492468281 13.389999999999999 4.960000000000001 L 14.120000000000001 4.72 C 14.023846850184563 4.705908873389905 13.92615314981544 4.705908873389905 13.830000000000002 4.72 L 8.11 4.72 C 7.557715250169206 4.72 7.109999999999999 5.1677152501692065 7.109999999999999 5.72 L 7.109999999999999 10.92 L 14.91 10.92 Z"
                                                stroke-linecap="round" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>

                        <div class="ml-4">
                            <div class="text-3xl font-bold text-gray-700">
                                {{ number_format($stats['votes'], 0, ',', '.') }}
                            </div>

                            <div class="text-sm text-gray-500">
                                Votos Registrados
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Eleição Ativa --}}
                <div class="w-full p-2 xl:w-1/4 sm:w-1/2">
                    <div class="flex flex-row items-center px-4 py-4">

                        <svg id='Online_32' width='32' height='32' viewBox='0 0 32 32'
                            xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'>
                            <rect width='32' height='32' stroke='none' fill='#000000' opacity='0' />


                            <g transform="matrix(0.56 0 0 0.56 16 16)">
                                <path
                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                    transform=" translate(-25, -25.06)"
                                    d="M 41.8125 6.96875 C 41.738281 6.976563 41.667969 6.984375 41.59375 7 C 40.855469 7.101563 40.234375 7.609375 39.984375 8.3125 C 39.734375 9.015625 39.898438 9.796875 40.40625 10.34375 C 43.878906 14.230469 46 19.347656 46 25 C 46 30.644531 43.894531 35.792969 40.40625 39.6875 C 39.851563 40.203125 39.636719 40.992188 39.851563 41.71875 C 40.066406 42.445313 40.671875 42.988281 41.417969 43.121094 C 42.164063 43.253906 42.921875 42.953125 43.375 42.34375 C 47.496094 37.742188 50 31.648438 50 25 C 50 18.351563 47.507813 12.28125 43.40625 7.6875 C 43.011719 7.214844 42.425781 6.953125 41.8125 6.96875 Z M 7.9375 7 C 7.417969 7.042969 6.933594 7.292969 6.59375 7.6875 C 2.492188 12.285156 0 18.371094 0 25 C 0 31.664063 2.503906 37.746094 6.625 42.34375 C 7.078125 42.953125 7.835938 43.253906 8.582031 43.121094 C 9.328125 42.988281 9.933594 42.445313 10.148438 41.71875 C 10.363281 40.992188 10.148438 40.203125 9.59375 39.6875 C 6.105469 35.796875 4 30.664063 4 25 C 4 19.371094 6.121094 14.234375 9.59375 10.34375 C 10.152344 9.734375 10.277344 8.84375 9.910156 8.105469 C 9.546875 7.363281 8.761719 6.925781 7.9375 7 Z M 34.65625 14.34375 C 34.582031 14.351563 34.511719 14.359375 34.4375 14.375 C 33.699219 14.476563 33.078125 14.984375 32.828125 15.6875 C 32.578125 16.390625 32.742188 17.171875 33.25 17.71875 C 34.964844 19.65625 36 22.183594 36 25 C 36 27.796875 34.960938 30.335938 33.25 32.28125 C 32.707031 32.804688 32.503906 33.589844 32.730469 34.3125 C 32.953125 35.03125 33.5625 35.566406 34.304688 35.691406 C 35.050781 35.816406 35.800781 35.515625 36.25 34.90625 C 38.578125 32.261719 40 28.789063 40 25 C 40 21.191406 38.589844 17.703125 36.25 15.0625 C 35.855469 14.589844 35.269531 14.328125 34.65625 14.34375 Z M 15.0625 14.40625 C 14.542969 14.449219 14.058594 14.699219 13.71875 15.09375 C 11.402344 17.734375 10 21.222656 10 25 C 10 28.847656 11.457031 32.378906 13.84375 35.03125 C 14.585938 35.851563 15.851563 35.914063 16.671875 35.171875 C 17.492188 34.429688 17.554688 33.164063 16.8125 32.34375 C 15.0625 30.398438 14 27.847656 14 25 C 14 22.210938 15.015625 19.691406 16.71875 17.75 C 17.277344 17.140625 17.402344 16.25 17.035156 15.511719 C 16.671875 14.769531 15.886719 14.332031 15.0625 14.40625 Z M 25 20 C 22.242188 20 20 22.242188 20 25 C 20 27.757813 22.242188 30 25 30 C 27.757813 30 30 27.757813 30 25 C 30 22.242188 27.757813 20 25 20 Z"
                                    stroke-linecap="round" />
                            </g>
                        </svg>

                        <div class="ml-4">
                            <div class="text-lg font-bold text-gray-700">
                                {{ $stats['activeElection'] ? 'ELEIÇÃO ATIVA' : 'INATIVA' }}
                            </div>

                            <div class="text-sm font-semibold">
                                {{ $stats['activeElection']?->title ?? 'Nenhuma eleição em andamento' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 px-4 mt-6 lg:grid-cols-2">

            <div class="bg-white border rounded-lg shadow-sm">

                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">
                        Status do Bot Telegram
                    </h3>
                </div>

                <div class="p-6">

                    @if ($botConfig)
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span>Status</span>

                                @if ($botConfig->active)
                                    <span class="font-semibold text-green-600">
                                        Ativo
                                    </span>
                                @else
                                    <span class="font-semibold text-red-600">
                                        Inativo
                                    </span>
                                @endif
                            </div>

                            <div class="flex justify-between">
                                <span>Frequência de envio</span>
                                <span>A cada {{ $botConfig->frequency_minutes }} min</span>
                            </div>

                            <div class="flex justify-between">
                                <span>Horário</span>

                                <span>
                                    {{ $botConfig->start_time->format('H:i') }}
                                    às
                                    {{ $botConfig->end_time->format('H:i') }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span>Último relatório enviado</span>

                                <span>
                                    {{ $botConfig->last_sent_at ? $botConfig->last_sent_at->format('d/m/Y H:i') : 'Nunca enviado' }}
                                </span>
                            </div>

                        </div>
                    @else
                        <p class="text-gray-500">
                            Nenhuma configuração encontrada.
                        </p>
                    @endif
                </div>
            </div>

            <div class="bg-white border rounded-lg shadow-sm mb-4">

                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">
                        Informações do Sistema
                    </h3>
                </div>

                <div class="p-6">
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span>Sistema</span>
                            <span class="font-semibold text-green-600">SIVE</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Laravel</span>
                            <span>{{ app()->version() }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Versão do PHP</span>
                            <span>{{ PHP_VERSION }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Timezone</span>
                            <span>{{ config('app.timezone') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Data e hora atual</span>
                            <span>{{ now()->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
