<style>
/* ==========================================================================
   SIAKAD EXCLUSIVE RANKING SYSTEM (Juara 1 - 3 Compact Dynamic Numerals)
   ========================================================================== */

@keyframes siakadRankShimmer {
    0% {
        background-position: -140% 0;
        opacity: 0;
    }
    20% {
        opacity: 0.72;
    }
    55% {
        background-position: 220% 0;
        opacity: 0;
    }
    100% {
        background-position: 220% 0;
        opacity: 0;
    }
}

@keyframes siakadCrownFloat {
    0%, 100% {
        transform: translateY(0) rotate(-10deg) scale(1);
    }
    50% {
        transform: translateY(-1.5px) rotate(-4deg) scale(1.06);
    }
}

@keyframes siakadGoldSheenGlow {
    0%, 100% {
        box-shadow: 0 1px 4px rgba(217, 119, 6, 0.16), inset 0 1px 0 rgba(255, 255, 255, 0.85);
    }
    50% {
        box-shadow: 0 2px 7px rgba(217, 119, 6, 0.28), inset 0 1px 0 rgba(255, 255, 255, 0.95);
    }
}

/* Base Pill Container — proportional compact height (~26px table / ~22px compact) */
.siakad-rank-badge {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 5.5px;
    padding: 2.5px 9px 2.5px 3.5px;
    border-radius: 9999px;
    font-family: 'Poppins', sans-serif;
    font-variant-numeric: tabular-nums;
    vertical-align: middle;
    user-select: none;
    transition: transform 0.2s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.2s ease;
    white-space: nowrap;
}

.siakad-rank-badge--compact {
    gap: 4.5px;
    padding: 2px 7.5px 2px 3px;
}

.siakad-rank-badge--top3 {
    overflow: visible;
}

.siakad-rank-badge--top3:hover {
    transform: translateY(-1px) scale(1.02);
}

/* Contained diagonal metallic glint (never leaks outside rounded capsule) */
.siakad-rank-badge--top3::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: inherit;
    background-image: linear-gradient(110deg, transparent 22%, rgba(255, 255, 255, 0.72) 50%, transparent 78%);
    background-repeat: no-repeat;
    background-size: 55% 100%;
    background-position: -140% 0;
    pointer-events: none;
    z-index: 1;
    animation: siakadRankShimmer 4.2s ease-in-out infinite;
}

/* Sculpted Geometric Shield Wrapper */
.siakad-rank-crest-wrap {
    position: relative;
    z-index: 3;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.siakad-rank-crest-crown {
    position: absolute;
    top: -4.5px;
    right: -2.5px;
    font-size: 7.5px;
    color: #d97706;
    filter: drop-shadow(0 1px 1px rgba(120, 53, 15, 0.35));
    pointer-events: none;
    z-index: 5;
    animation: siakadCrownFloat 2.8s ease-in-out infinite;
}

.siakad-rank-badge--compact .siakad-rank-crest-crown {
    top: -4px;
    right: -2.5px;
    font-size: 7px;
}

/* Compact Sculpted Octagonal Numeral Jewel */
.siakad-rank-coin {
    position: relative;
    z-index: 3;
    width: 20px;
    height: 20px;
    clip-path: polygon(22% 0%, 78% 0%, 100% 22%, 100% 78%, 78% 100%, 22% 100%, 0% 78%, 0% 22%);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 11px;
    line-height: 1;
    letter-spacing: -0.03em;
    flex-shrink: 0;
    transition: transform 0.24s cubic-bezier(0.22, 1, 0.36, 1);
}

.siakad-rank-badge--compact .siakad-rank-coin {
    width: 17px;
    height: 17px;
    font-size: 10px;
}

.siakad-rank-badge--top3:hover .siakad-rank-coin {
    transform: scale(1.08);
}

/* Subtle top specular facet */
.siakad-rank-coin::before {
    content: "";
    position: absolute;
    inset: 1.5px;
    clip-path: polygon(22% 0%, 78% 0%, 100% 22%, 100% 78%, 78% 100%, 22% 100%, 0% 78%, 0% 22%);
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.38) 0%, transparent 52%);
    pointer-events: none;
}

.siakad-rank-meta {
    position: relative;
    z-index: 3;
    display: inline-flex;
    align-items: center;
    gap: 3.5px;
    line-height: 1;
}

.siakad-rank-tier-label {
    font-size: 9.5px;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.siakad-rank-badge--compact .siakad-rank-tier-label {
    font-size: 9px;
    letter-spacing: 0.03em;
}

/* --- JUARA 1: ROYAL SOVEREIGN GOLD (Crisp 1px border) --- */
.siakad-rank-1 {
    background: linear-gradient(135deg, #fffdf6 0%, #fef3c7 52%, #fde68a 100%);
    color: #92400e;
    border: 1px solid rgba(217, 119, 6, 0.45);
    animation: siakadGoldSheenGlow 3.6s ease-in-out infinite;
}

.siakad-rank-1::after {
    animation-delay: 0s;
}

.siakad-rank-1 .siakad-rank-crest-wrap {
    filter: drop-shadow(0 1px 2px rgba(180, 83, 9, 0.25));
}

.siakad-rank-1 .siakad-rank-coin {
    background: linear-gradient(155deg, #fef08a 0%, #f59e0b 52%, #b45309 100%);
    color: #451a03;
    text-shadow: 0 0.5px 0 rgba(255, 255, 255, 0.55);
}

/* --- JUARA 2: LIQUID PLATINUM SILVER (Crisp 1px border) --- */
.siakad-rank-2 {
    background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 55%, #e2e8f0 100%);
    color: #334155;
    border: 1px solid rgba(100, 116, 139, 0.42);
    box-shadow: 0 1px 3px rgba(51, 65, 85, 0.12), inset 0 1px 0 #ffffff;
}

.siakad-rank-2::after {
    animation-delay: 1.2s;
}

.siakad-rank-2 .siakad-rank-crest-wrap {
    filter: drop-shadow(0 1px 2px rgba(51, 65, 85, 0.2));
}

.siakad-rank-2 .siakad-rank-coin {
    background: linear-gradient(155deg, #f8fafc 0%, #cbd5e1 50%, #64748b 100%);
    color: #0f172a;
    text-shadow: 0 0.5px 0 rgba(255, 255, 255, 0.65);
}

.siakad-rank-2 .siakad-rank-icon {
    color: #475569;
}

/* --- JUARA 3: BURNISHED ROYAL BRONZE (Crisp 1px border) --- */
.siakad-rank-3 {
    background: linear-gradient(135deg, #fffaf5 0%, #ffedd5 55%, #fed7aa 100%);
    color: #9a3412;
    border: 1px solid rgba(194, 65, 12, 0.38);
    box-shadow: 0 1px 3px rgba(124, 45, 18, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.85);
}

.siakad-rank-3::after {
    animation-delay: 2.4s;
}

.siakad-rank-3 .siakad-rank-crest-wrap {
    filter: drop-shadow(0 1px 2px rgba(124, 45, 18, 0.22));
}

.siakad-rank-3 .siakad-rank-coin {
    background: linear-gradient(155deg, #fdba74 0%, #ea580c 52%, #9a3412 100%);
    color: #fffbeb;
    text-shadow: 0 1px 1px rgba(67, 20, 7, 0.5);
}

.siakad-rank-3 .siakad-rank-icon {
    color: #c2410c;
}

/* --- RANK 4+ MINIMAL CLEAN CAPSULE --- */
.siakad-rank-other {
    background: #f8fafc;
    color: #475569;
    border: 1px solid #e2e8f0;
    padding: 2px 8px;
}

.siakad-rank-badge--compact.siakad-rank-other {
    padding: 1.5px 7px;
}

/* --- SUBTLE TOP 3 ROW ACCENT BORDERS --- */
.siakad-rank-row-1 {
    background: linear-gradient(90deg, rgba(254, 243, 199, 0.32) 0%, rgba(255, 251, 235, 0.12) 40%, transparent 78%);
    box-shadow: inset 2.5px 0 0 #eab308;
}

.siakad-rank-row-1:hover {
    background: linear-gradient(90deg, rgba(254, 243, 199, 0.5) 0%, rgba(255, 251, 235, 0.22) 48%, rgba(248, 250, 252, 0.65) 100%) !important;
}

.siakad-rank-row-2 {
    background: linear-gradient(90deg, rgba(226, 232, 240, 0.32) 0%, rgba(248, 250, 252, 0.14) 40%, transparent 78%);
    box-shadow: inset 2.5px 0 0 #94a3b8;
}

.siakad-rank-row-2:hover {
    background: linear-gradient(90deg, rgba(226, 232, 240, 0.5) 0%, rgba(248, 250, 252, 0.24) 48%, rgba(248, 250, 252, 0.65) 100%) !important;
}

.siakad-rank-row-3 {
    background: linear-gradient(90deg, rgba(255, 237, 213, 0.3) 0%, rgba(255, 247, 237, 0.12) 40%, transparent 78%);
    box-shadow: inset 2.5px 0 0 #ea580c;
}

.siakad-rank-row-3:hover {
    background: linear-gradient(90deg, rgba(255, 237, 213, 0.48) 0%, rgba(255, 247, 237, 0.22) 48%, rgba(248, 250, 252, 0.65) 100%) !important;
}

/* Print Safe Rules */
.siakad-rank-print {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 3.5px;
    padding: 1.5px 6px;
    border-radius: 5px;
    font-weight: 800;
    font-size: 10.5px;
    font-variant-numeric: tabular-nums;
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
}

.siakad-rank-print-1 {
    background: #fef3c7 !important;
    color: #78350f !important;
    border: 1px solid #d97706 !important;
}

.siakad-rank-print-2 {
    background: #f1f5f9 !important;
    color: #1e293b !important;
    border: 1px solid #64748b !important;
}

.siakad-rank-print-3 {
    background: #ffedd5 !important;
    color: #7c2d12 !important;
    border: 1px solid #c2410c !important;
}

@media print {
    .siakad-rank-badge--top3::after {
        display: none !important;
        animation: none !important;
    }
    .siakad-rank-badge,
    .siakad-rank-coin,
    .siakad-rank-crest-wrap,
    .siakad-rank-crest-crown,
    .siakad-rank-1,
    .siakad-rank-2,
    .siakad-rank-3,
    .siakad-rank-print {
        animation: none !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
}

@media (prefers-reduced-motion: reduce) {
    .siakad-rank-badge--top3::after,
    .siakad-rank-1,
    .siakad-rank-crest-crown {
        animation: none !important;
    }
}
</style>
