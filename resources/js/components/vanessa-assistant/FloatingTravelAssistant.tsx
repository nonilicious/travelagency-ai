'use client';

import { AnimatePresence, motion } from 'framer-motion';
import { ChatWindow } from './ChatWindow';
import { useVanessaAssistant } from './useVanessaAssistant';
import { VanessaAvatar } from './VanessaAvatar';

type FloatingTravelAssistantProps = {
    className?: string;
};

export function FloatingTravelAssistant({ className = '' }: FloatingTravelAssistantProps) {
    const assistant = useVanessaAssistant();
    const bubbleText = assistant.mood === 'wave'
        ? 'Hi 😊 Brauchst du Hilfe bei deiner Reiseplanung?'
        : assistant.suggestion.message;

    return (
        <>
            <ChatWindow
                draft={assistant.draft}
                isOpen={assistant.isOpen}
                isTyping={assistant.isTyping}
                messages={assistant.messages}
                onClose={assistant.closeChat}
                onDraftChange={assistant.setDraft}
                onSend={assistant.sendMessage}
            />

            <motion.div
                animate={{
                    x: assistant.mood === 'peek' ? 54 : assistant.walkOffset.x,
                    y: assistant.walkOffset.y,
                }}
                className={`fixed bottom-5 right-4 z-50 sm:bottom-6 sm:right-6 ${className}`}
                transition={{ type: 'spring', stiffness: 120, damping: 16 }}
            >
                <AnimatePresence>
                    {assistant.isBubbleVisible && !assistant.isOpen ? (
                        <motion.button
                            animate={{ opacity: 1, y: 0, scale: 1 }}
                            className="absolute bottom-[6.5rem] right-6 w-64 rounded-3xl rounded-br-md border border-white/70 bg-white/82 px-4 py-3 text-left text-sm font-semibold leading-6 text-stone-800 shadow-2xl shadow-stone-950/15 ring-1 ring-stone-900/5 backdrop-blur-xl transition hover:-translate-y-0.5 sm:w-72"
                            exit={{ opacity: 0, y: 10, scale: 0.98 }}
                            initial={{ opacity: 0, y: 10, scale: 0.98 }}
                            onClick={assistant.openChat}
                            type="button"
                        >
                            {bubbleText}
                            <span className="absolute -bottom-2 right-7 h-4 w-4 rotate-45 border-b border-r border-white/70 bg-white/82" />
                        </motion.button>
                    ) : null}
                </AnimatePresence>

                <motion.button
                    aria-label="Open Vanessa travel assistant"
                    className="group relative grid h-24 w-24 place-items-center rounded-full bg-gradient-to-br from-white/82 via-emerald-50/82 to-stone-100/82 shadow-2xl shadow-stone-950/20 ring-1 ring-white/80 backdrop-blur-xl transition focus:outline-none focus:ring-4 focus:ring-emerald-900/16 sm:h-28 sm:w-28"
                    onClick={assistant.openChat}
                    onMouseEnter={assistant.markInteraction}
                    type="button"
                    whileHover={{ y: -5, scale: 1.04 }}
                    whileTap={{ scale: 0.96 }}
                >
                    <span className="absolute inset-2 rounded-full border border-emerald-900/10" />
                    <motion.span
                        animate={{ opacity: [0.25, 0.55, 0.25], scale: [1, 1.08, 1] }}
                        className="absolute inset-0 rounded-full bg-emerald-200/25"
                        transition={{ duration: 3.6, repeat: Infinity, ease: 'easeInOut' }}
                    />
                    <VanessaAvatar mood={assistant.mood} size="medium" />
                    <span className="absolute bottom-2 right-3 h-3 w-3 rounded-full border-2 border-white bg-emerald-500 shadow-sm" />
                </motion.button>
            </motion.div>
        </>
    );
}
