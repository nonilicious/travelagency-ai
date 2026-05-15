'use client';

import { AnimatePresence, motion } from 'framer-motion';
import { ChatWindow } from './ChatWindow';
import { useVanessaAssistant } from './useVanessaAssistant';
import { VanessaSpriteAvatar } from './VanessaSpriteAvatar';

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
                className={`fixed bottom-0 right-3 z-50 sm:bottom-0 sm:right-8 ${className}`}
                transition={{ type: 'spring', stiffness: 80, damping: 14, mass: 0.9 }}
            >
                <AnimatePresence>
                    {assistant.isBubbleVisible && !assistant.isOpen ? (
                        <motion.button
                            animate={{ opacity: 1, y: 0, scale: 1 }}
                            className="absolute bottom-[13rem] right-8 w-64 rounded-3xl rounded-br-md border border-white/70 bg-white/82 px-4 py-3 text-left text-sm font-semibold leading-6 text-stone-800 shadow-2xl shadow-stone-950/15 ring-1 ring-stone-900/5 backdrop-blur-xl transition hover:-translate-y-0.5 sm:w-72"
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
                    className="group relative grid h-56 w-44 place-items-end rounded-[2rem] bg-transparent transition focus:outline-none focus:ring-4 focus:ring-emerald-900/16 sm:h-64 sm:w-52"
                    onClick={assistant.openChat}
                    onMouseEnter={assistant.markInteraction}
                    type="button"
                    whileHover={{ y: -5, scale: 1.04 }}
                    whileTap={{ scale: 0.96 }}
                >
                    <VanessaSpriteAvatar mood={assistant.mood} size="medium" />
                </motion.button>
            </motion.div>
        </>
    );
}
