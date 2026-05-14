'use client';

import { AnimatePresence, motion } from 'framer-motion';
import { FormEvent } from 'react';
import type { AssistantMessage } from './types';
import { TypingIndicator } from './TypingIndicator';
import { VanessaAvatar } from './VanessaAvatar';

type ChatWindowProps = {
    draft: string;
    isOpen: boolean;
    isTyping: boolean;
    messages: AssistantMessage[];
    onClose: () => void;
    onDraftChange: (value: string) => void;
    onSend: (value: string) => void;
};

const quickReplies = ['Italien im Sommer', 'Japan Kulturreise', 'Romantische Reise', 'Budget 3.000 EUR'];

export function ChatWindow({
    draft,
    isOpen,
    isTyping,
    messages,
    onClose,
    onDraftChange,
    onSend,
}: ChatWindowProps) {
    const handleSubmit = (event: FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        onSend(draft);
    };

    return (
        <AnimatePresence>
            {isOpen ? (
                <motion.aside
                    animate={{ opacity: 1, y: 0, scale: 1 }}
                    className="fixed bottom-28 right-4 z-50 flex h-[min(680px,calc(100dvh-8rem))] w-[min(360px,calc(100vw-2rem))] flex-col overflow-hidden rounded-[2rem] border border-white/55 bg-white/72 shadow-2xl shadow-stone-950/20 ring-1 ring-stone-900/5 backdrop-blur-2xl sm:right-6"
                    exit={{ opacity: 0, y: 24, scale: 0.96 }}
                    initial={{ opacity: 0, y: 24, scale: 0.96 }}
                    role="dialog"
                    aria-label="Vanessa travel assistant chat"
                    transition={{ duration: 0.24, ease: [0.22, 1, 0.36, 1] }}
                >
                    <div className="relative border-b border-white/60 bg-gradient-to-br from-emerald-950/90 via-stone-900/88 to-stone-800/86 p-5 text-white">
                        <div className="absolute inset-0 bg-[radial-gradient(circle_at_18%_0%,rgba(255,255,255,.22),transparent_34%)]" />
                        <div className="relative flex items-center gap-4">
                            <div className="grid h-16 w-14 place-items-end rounded-2xl bg-white/12 ring-1 ring-white/20">
                                <VanessaAvatar mood="idle" size="small" />
                            </div>
                            <div className="min-w-0 flex-1">
                                <p className="!m-0 !text-xs !font-semibold !uppercase !leading-5 !tracking-[0.18em] !text-emerald-100/80">Travel assistant</p>
                                <h2 className="!m-0 truncate !text-xl !font-semibold !leading-tight !tracking-normal !text-white">Vanessa</h2>
                                <p className="!m-0 !text-sm !leading-5 !text-emerald-50/78">Plant mit dir eine klare Anfrage.</p>
                            </div>
                            <button
                                aria-label="Close Vanessa chat"
                                className="grid h-10 w-10 place-items-center rounded-full bg-white/10 text-xl leading-none text-white transition hover:bg-white/20"
                                onClick={onClose}
                                type="button"
                            >
                                x
                            </button>
                        </div>
                    </div>

                    <div className="flex-1 space-y-4 overflow-y-auto px-4 py-5">
                        {messages.map((message) => (
                            <div className={`flex ${message.role === 'user' ? 'justify-end' : 'justify-start'}`} key={message.id}>
                                <div
                                    className={`max-w-[82%] rounded-3xl px-4 py-3 text-sm leading-6 shadow-sm ${
                                        message.role === 'user'
                                            ? 'rounded-br-md bg-emerald-950 text-white'
                                            : 'rounded-bl-md bg-white/86 text-stone-800 ring-1 ring-stone-200/70'
                                    }`}
                                >
                                    {message.text}
                                </div>
                            </div>
                        ))}

                        {isTyping ? (
                            <div className="flex justify-start">
                                <TypingIndicator />
                            </div>
                        ) : null}
                    </div>

                    <div className="border-t border-white/70 bg-white/62 p-4">
                        <div className="mb-3 flex gap-2 overflow-x-auto pb-1">
                            {quickReplies.map((reply) => (
                                <button
                                    className="shrink-0 rounded-full border border-stone-200 bg-white/78 px-3 py-2 text-xs font-semibold text-stone-700 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-700/35 hover:text-emerald-950"
                                    key={reply}
                                    onClick={() => onDraftChange(reply)}
                                    type="button"
                                >
                                    {reply}
                                </button>
                            ))}
                        </div>

                        <form className="flex items-end gap-2" onSubmit={handleSubmit}>
                            <label className="sr-only" htmlFor="vanessa-message">
                                Message Vanessa
                            </label>
                            <textarea
                                className="max-h-32 min-h-12 flex-1 resize-none rounded-2xl border border-stone-200 bg-white/85 px-4 py-3 text-sm leading-5 text-stone-900 shadow-inner outline-none transition placeholder:text-stone-400 focus:border-emerald-700/55 focus:ring-4 focus:ring-emerald-900/10"
                                id="vanessa-message"
                                onChange={(event) => onDraftChange(event.target.value)}
                                onKeyDown={(event) => {
                                    if (event.key === 'Enter' && !event.shiftKey) {
                                        event.preventDefault();
                                        onSend(draft);
                                    }
                                }}
                                placeholder="Wohin moechtest du reisen?"
                                rows={1}
                                value={draft}
                            />
                            <button
                                className="grid h-12 min-w-12 place-items-center rounded-2xl bg-emerald-950 px-4 text-sm font-bold text-white shadow-lg shadow-emerald-950/20 transition hover:-translate-y-0.5 hover:bg-emerald-900"
                                type="submit"
                            >
                                Send
                            </button>
                        </form>
                    </div>
                </motion.aside>
            ) : null}
        </AnimatePresence>
    );
}
