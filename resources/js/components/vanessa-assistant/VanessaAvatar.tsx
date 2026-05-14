'use client';

import { motion, type Variants } from 'framer-motion';
import type { VanessaMood } from './types';

type VanessaAvatarProps = {
    mood?: VanessaMood;
    size?: 'small' | 'medium' | 'large';
    className?: string;
};

const sizeClasses = {
    small: 'h-16 w-12',
    medium: 'h-28 w-20',
    large: 'h-36 w-28',
};

const bodyVariants: Variants = {
    idle: {
        y: [0, -2, 0],
        rotate: [0, -1, 0.5, 0],
        transition: {
            duration: 4.2,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    wave: {
        y: [0, -3, 0],
        rotate: [0, -2, 1, 0],
        transition: {
            duration: 2.8,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    thinking: {
        rotate: [0, -1.5, 1.5, 0],
        transition: {
            duration: 2.4,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    peek: {
        x: [16, 0, 10],
        rotate: [0, -6, -2],
        transition: {
            duration: 2.8,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    walk: {
        x: [0, -5, 3, 0],
        y: [0, -1, 0, -1, 0],
        rotate: [0, -2, 2, -1, 0],
        transition: {
            duration: 1.6,
            ease: 'easeInOut',
        },
    },
};

const armVariants: Variants = {
    idle: {
        rotate: [0, -3, 0],
        transition: {
            duration: 4,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    wave: {
        rotate: [-8, -34, -12, -38, -8],
        transition: {
            duration: 1.2,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    thinking: {
        rotate: [-20, -28, -20],
        transition: {
            duration: 2.2,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    peek: {
        rotate: [-10, -22, -10],
        transition: {
            duration: 2.4,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    walk: {
        rotate: [-12, 10, -8],
        transition: {
            duration: 0.8,
            repeat: 2,
            ease: 'easeInOut',
        },
    },
};

const hairVariants: Variants = {
    idle: {
        rotate: [0, 1.4, -1.2, 0],
        transition: {
            duration: 4.8,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    wave: {
        rotate: [0, 2.5, -1.5, 0],
        transition: {
            duration: 2.2,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    thinking: {
        rotate: [0, -1, 1, 0],
        transition: {
            duration: 3.2,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    peek: {
        rotate: [-4, 2, -2],
        transition: {
            duration: 2.6,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    walk: {
        rotate: [-3, 3, -2],
        transition: {
            duration: 0.75,
            repeat: 2,
            ease: 'easeInOut',
        },
    },
};

export function VanessaAvatar({ mood = 'idle', size = 'medium', className = '' }: VanessaAvatarProps) {
    return (
        <motion.svg
            aria-label="Vanessa travel assistant"
            className={`${sizeClasses[size]} drop-shadow-[0_18px_26px_rgba(23,33,31,0.22)] ${className}`}
            initial={false}
            animate={mood}
            variants={bodyVariants}
            viewBox="0 0 160 240"
            role="img"
        >
            <defs>
                <linearGradient id="vanessa-jacket" x1="0" x2="1" y1="0" y2="1">
                    <stop offset="0%" stopColor="#768258" />
                    <stop offset="100%" stopColor="#445039" />
                </linearGradient>
                <linearGradient id="vanessa-pants" x1="0" x2="0" y1="0" y2="1">
                    <stop offset="0%" stopColor="#d4c1a1" />
                    <stop offset="100%" stopColor="#a8906f" />
                </linearGradient>
            </defs>

            <ellipse cx="80" cy="230" rx="48" ry="8" fill="rgba(23,33,31,.18)" />

            <motion.g variants={hairVariants} style={{ transformOrigin: '80px 62px' }}>
                {Array.from({ length: 18 }).map((_, index) => {
                    const x = 46 + (index % 9) * 8;
                    const y = 23 + (index % 4) * 2;
                    const d = `M${x} ${y} C${x - 16 + (index % 3) * 5} ${55 + index}, ${x - 10} ${78 + index * 2}, ${x - 18 + (index % 5) * 8} ${112 + index}`;

                    return (
                        <path
                            d={d}
                            fill="none"
                            key={index}
                            stroke={index % 2 ? '#2a160c' : '#57300f'}
                            strokeLinecap="round"
                            strokeWidth={index % 3 === 0 ? 3.8 : 2.7}
                        />
                    );
                })}
            </motion.g>

            <path d="M50 100 C38 116 35 147 45 176" fill="none" stroke="#7b502a" strokeLinecap="round" strokeWidth="8" />
            <path d="M110 100 C122 118 124 149 114 178" fill="none" stroke="#7b502a" strokeLinecap="round" strokeWidth="8" />

            <path d="M58 86 C49 102 43 125 41 151 C53 160 106 161 119 150 C116 122 110 102 101 86 Z" fill="url(#vanessa-jacket)" />
            <path d="M66 88 C69 117 68 144 64 164 L95 164 C91 139 91 116 94 88 Z" fill="#151817" />
            <path d="M67 95 C54 104 50 125 49 153" fill="none" stroke="#2f3928" strokeLinecap="round" strokeWidth="2" />
            <path d="M93 95 C106 104 111 126 112 153" fill="none" stroke="#2f3928" strokeLinecap="round" strokeWidth="2" />

            <path d="M62 157 L58 219 L78 219 L81 157 Z" fill="url(#vanessa-pants)" />
            <path d="M83 157 L87 219 L107 219 L99 157 Z" fill="url(#vanessa-pants)" />
            <path d="M58 180 L76 180" stroke="#8e785c" strokeWidth="2" />
            <path d="M89 181 L105 181" stroke="#8e785c" strokeWidth="2" />
            <rect x="59" y="121" width="43" height="8" rx="3" fill="#4a321d" />
            <rect x="77" y="120" width="14" height="10" rx="2" fill="#bd9b60" />

            <motion.g variants={armVariants} style={{ transformOrigin: '48px 100px' }}>
                <path d="M48 97 C37 112 34 133 37 154" fill="none" stroke="#66724e" strokeLinecap="round" strokeWidth="14" />
                <path d="M36 154 C32 165 31 174 34 184" fill="none" stroke="#b67838" strokeLinecap="round" strokeWidth="9" />
                <path d="M31 183 C24 180 21 175 18 169" fill="none" stroke="#b67838" strokeLinecap="round" strokeWidth="4" />
                <path d="M31 183 C24 183 20 181 15 178" fill="none" stroke="#b67838" strokeLinecap="round" strokeWidth="4" />
            </motion.g>
            <path d="M112 99 C124 116 126 138 121 158" fill="none" stroke="#66724e" strokeLinecap="round" strokeWidth="14" />
            <path d="M121 158 C124 168 123 177 119 186" fill="none" stroke="#b67838" strokeLinecap="round" strokeWidth="9" />

            <path d="M55 219 L81 219 C84 226 80 231 70 231 L53 231 C51 226 52 222 55 219 Z" fill="#b33f23" />
            <path d="M85 219 L111 219 C116 226 112 231 101 231 L84 231 C82 226 82 222 85 219 Z" fill="#b33f23" />
            <path d="M55 228 L80 228" stroke="#fff4e1" strokeLinecap="round" strokeWidth="3" />
            <path d="M86 228 L111 228" stroke="#fff4e1" strokeLinecap="round" strokeWidth="3" />
            <path d="M63 222 L73 229 M68 222 L76 229 M94 222 L104 229 M99 222 L107 229" stroke="#fff4e1" strokeLinecap="round" strokeWidth="1.4" />

            <path d="M54 53 C54 35 67 23 81 23 C97 23 108 36 107 54 C106 74 95 87 80 87 C65 87 55 73 54 53 Z" fill="#b8783f" />
            <path d="M55 57 C47 54 49 71 58 70" fill="#b8783f" />
            <path d="M105 57 C113 54 111 71 102 70" fill="#b8783f" />
            <path d="M62 48 C70 41 89 38 101 49 C96 29 66 25 58 43 Z" fill="#1d1109" />

            <path d="M60 54 C65 49 73 49 78 54 L76 64 C70 67 63 65 59 60 Z" fill="#171717" />
            <path d="M82 54 C88 49 97 49 102 55 L100 61 C95 66 87 66 83 63 Z" fill="#171717" />
            <path d="M77 56 L84 56" stroke="#171717" strokeWidth="3" />
            <path d="M66 52 C69 50 73 50 76 53" stroke="#343434" strokeLinecap="round" strokeWidth="1.5" />
            <path d="M88 52 C92 50 97 51 100 54" stroke="#343434" strokeLinecap="round" strokeWidth="1.5" />

            <motion.path
                animate={{ scaleY: [1, 0.18, 1] }}
                d="M69 71 C75 76 86 76 92 70"
                fill="none"
                stroke="#4b1d13"
                strokeLinecap="round"
                strokeWidth="2.3"
                style={{ transformOrigin: '80px 70px' }}
                transition={{ duration: 4.8, repeat: Infinity, repeatDelay: 3.2 }}
            />

            <path d="M52 56 C44 47 47 37 56 34" fill="none" stroke="#202020" strokeLinecap="round" strokeWidth="3" />
            <path d="M108 56 C116 47 113 37 104 34" fill="none" stroke="#202020" strokeLinecap="round" strokeWidth="3" />
            <circle cx="51" cy="56" r="7" fill="#262626" />
            <circle cx="109" cy="56" r="7" fill="#262626" />
            <path d="M108 63 C119 66 120 73 113 77" fill="none" stroke="#1b1b1b" strokeLinecap="round" strokeWidth="2" />
            <circle cx="112" cy="77" r="2.3" fill="#1b1b1b" />

            <path d="M75 87 L69 114" stroke="#c69a54" strokeLinecap="round" strokeWidth="1.5" />
            <path d="M85 87 L91 114" stroke="#c69a54" strokeLinecap="round" strokeWidth="1.5" />
            <circle cx="80" cy="103" r="6" fill="#c8b47e" stroke="#4d3d25" strokeWidth="1.4" />
        </motion.svg>
    );
}
