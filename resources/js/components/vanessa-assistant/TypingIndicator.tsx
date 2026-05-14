'use client';

import { motion } from 'framer-motion';

export function TypingIndicator() {
    return (
        <div className="flex items-center gap-1 rounded-2xl bg-white/70 px-4 py-3 shadow-sm ring-1 ring-stone-200/70">
            {[0, 1, 2].map((index) => (
                <motion.span
                    animate={{ y: [0, -4, 0], opacity: [0.45, 1, 0.45] }}
                    className="h-2 w-2 rounded-full bg-emerald-800"
                    key={index}
                    transition={{
                        duration: 0.85,
                        repeat: Infinity,
                        delay: index * 0.16,
                        ease: 'easeInOut',
                    }}
                />
            ))}
        </div>
    );
}
