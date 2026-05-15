'use client';

import { AnimatePresence, motion, type Variants } from 'framer-motion';
import type { VanessaMood } from './types';

type VanessaSpriteAvatarProps = {
    mood?: VanessaMood;
    size?: 'small' | 'medium' | 'large';
    className?: string;
};

const sizeClasses = {
    small: 'h-16 w-14',
    medium: 'h-56 w-40',
    large: 'h-64 w-48',
};

const spriteByMood: Record<VanessaMood, string> = {
    idle: '/images/vanessa/vanessa-idle.png',
    wave: '/images/vanessa/vanessa-wave.png',
    thinking: '/images/vanessa/vanessa-thinking.png',
    peek: '/images/vanessa/vanessa-peek.png',
    walk: '/images/vanessa/vanessa-walk.png',
};

const motionByMood: Variants = {
    idle: {
        y: [0, -3, 0],
        rotate: [0, -0.8, 0.8, 0],
        transition: {
            duration: 4.4,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    wave: {
        y: [0, -5, 0],
        rotate: [0, -3, 2, -2, 0],
        transition: {
            duration: 1.8,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    thinking: {
        y: [0, -2, 0],
        rotate: [-1.5, 1.2, -1.5],
        transition: {
            duration: 2.8,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    peek: {
        x: [10, -2, 8],
        rotate: [-4, 1.5, -4],
        transition: {
            duration: 2.8,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
    walk: {
        x: [0, -6, 4, 0],
        y: [0, -2, 0, -2, 0],
        rotate: [-1, 2, -2, 1, -1],
        transition: {
            duration: 1.2,
            repeat: Infinity,
            ease: 'easeInOut',
        },
    },
};

export function VanessaSpriteAvatar({ mood = 'idle', size = 'medium', className = '' }: VanessaSpriteAvatarProps) {
    if (size === 'small') {
        const portraitSrc = mood === 'thinking' ? '/images/vanessa/vanessa-bust.png' : '/images/vanessa/vanessa-bust-happy.png';

        return (
            <motion.img
                alt="Vanessa travel assistant"
                animate={{ y: [0, -1.5, 0], scale: [1, 1.02, 1] }}
                className={`h-full w-full object-cover object-top ${className}`}
                draggable={false}
                src={portraitSrc}
                transition={{ duration: 3.2, repeat: Infinity, ease: 'easeInOut' }}
            />
        );
    }

    const src = spriteByMood[mood] ?? spriteByMood.idle;

    return (
        <motion.div
            animate={mood}
            className={`relative grid place-items-end ${sizeClasses[size]} ${className}`}
            initial={false}
            variants={motionByMood}
        >
            <motion.div
                animate={{ opacity: [0.16, 0.28, 0.16], scale: [0.94, 1.04, 0.94] }}
                className="absolute bottom-0 h-4 w-24 rounded-full bg-stone-950/24 blur-[3px]"
                transition={{ duration: 3.4, repeat: Infinity, ease: 'easeInOut' }}
            />
            <AnimatePresence mode="wait">
                <motion.img
                    alt="Vanessa travel assistant"
                    className="relative max-h-full max-w-full object-contain drop-shadow-[0_18px_18px_rgba(23,33,31,0.24)]"
                    draggable={false}
                    exit={{ opacity: 0, scale: 0.94, y: 4 }}
                    initial={{ opacity: 0, scale: 0.96, y: 5 }}
                    key={src}
                    src={src}
                    animate={{ opacity: 1, scale: 1, y: 0 }}
                    transition={{ duration: 0.18, ease: 'easeOut' }}
                />
            </AnimatePresence>
        </motion.div>
    );
}
