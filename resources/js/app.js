//
const eyeIcon = `
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
    </svg>`;

const eyeOffIcon = `
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 2.036 12.322a1.012 1.012 0 0 0 0 .639C3.423 17.49 7.36 20.5 12 20.5c1.88 0 3.61-.514 5.11-1.403M6.228 6.228A10.45 10.45 0 0 1 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639a10.53 10.53 0 0 1-4.112 5.033M6.228 6.228 3 3m3.228 3.228 12.544 12.544M9.88 9.88a3 3 0 0 0 4.24 4.24"/>
    </svg>`;

function addPasswordToggle(input) {
    if (input.dataset.passwordToggleInitialized === 'true') {
        return;
    }

    input.dataset.passwordToggleInitialized = 'true';

    const existingToggle = input.parentElement.querySelector(`button[aria-controls="${input.id}"]`);
    const wrapper = existingToggle ? input.parentElement : document.createElement('div');

    if (!existingToggle) {
        wrapper.className = 'password-input-wrapper relative';
        input.parentNode.insertBefore(wrapper, input);
        wrapper.appendChild(input);
    }

    input.classList.add('pr-12');

    const toggle = existingToggle || document.createElement('button');
    toggle.className = 'absolute inset-y-0 right-0 flex min-h-11 min-w-11 items-center justify-center text-gray-500 transition hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500';
    toggle.type = 'button';
    toggle.setAttribute('aria-controls', input.id || input.name);
    toggle.setAttribute('aria-label', 'Show password');
    toggle.setAttribute('aria-pressed', 'false');
    toggle.innerHTML = eyeIcon;

    if (!existingToggle) {
        wrapper.appendChild(toggle);
    }

    toggle.addEventListener('click', () => {
        const isVisible = input.type === 'text';

        input.type = isVisible ? 'password' : 'text';
        toggle.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');
        toggle.setAttribute('aria-pressed', String(!isVisible));
        toggle.innerHTML = isVisible ? eyeIcon : eyeOffIcon;
    });
}

document.querySelectorAll('input[type="password"]').forEach(addPasswordToggle);

document.querySelectorAll('[data-tabs]').forEach((tabs) => {
    const tabButtons = [...tabs.querySelectorAll('[role="tab"]')];
    const tabPanels = [...tabs.querySelectorAll('[role="tabpanel"]')];

    function selectTab(tabId, moveFocus = false) {
        tabButtons.forEach((tab) => {
            const selected = tab.dataset.tabTarget === tabId;
            tab.setAttribute('aria-selected', String(selected));
            tab.tabIndex = selected ? 0 : -1;
            tab.classList.toggle('border-indigo-600', selected);
            tab.classList.toggle('text-indigo-700', selected);
            tab.classList.toggle('border-transparent', !selected);
            tab.classList.toggle('text-gray-500', !selected);
            tab.classList.toggle('hover:border-gray-300', !selected);
            tab.classList.toggle('hover:text-gray-700', !selected);
        });
        tabPanels.forEach((panel) => {
            panel.classList.toggle('hidden', panel.dataset.tabPanel !== tabId);
        });
        if (moveFocus) {
            tabButtons.find((tab) => tab.dataset.tabTarget === tabId)?.focus();
        }
    }

    tabButtons.forEach((tab, index) => {
        tab.addEventListener('click', () => selectTab(tab.dataset.tabTarget));
        tab.addEventListener('keydown', (event) => {
            if (!['ArrowRight', 'ArrowLeft', 'Home', 'End'].includes(event.key)) {
                return;
            }
            event.preventDefault();
            const nextIndex = event.key === 'Home' ? 0
                : event.key === 'End' ? tabButtons.length - 1
                : (index + (event.key === 'ArrowRight' ? 1 : -1) + tabButtons.length) % tabButtons.length;
            selectTab(tabButtons[nextIndex].dataset.tabTarget, true);
        });
    });
});

const confirmationModal = document.getElementById('confirmation-modal');
const confirmationTitle = confirmationModal?.querySelector('#confirmation-modal-title');
const confirmationMessage = confirmationModal?.querySelector('#confirmation-modal-message');
const confirmationPanel = confirmationModal?.querySelector('[data-confirm-panel]');
const confirmationCancel = confirmationModal?.querySelector('[data-confirm-cancel]');
const confirmationSubmit = confirmationModal?.querySelector('[data-confirm-submit]');
const confirmationInput = confirmationModal?.querySelector('[data-confirm-input]');
const confirmationInputWrap = confirmationModal?.querySelector('[data-confirm-input-wrap]');
const confirmationFeedback = confirmationModal?.querySelector('[data-confirm-feedback]');
let pendingConfirmation = null;
let lastFocusedElement = null;

function closeConfirmation() {
    if (!confirmationModal) {
        return;
    }

    confirmationModal.classList.add('hidden');
    confirmationModal.classList.remove('flex');
    confirmationSubmit.disabled = false;
    confirmationInputWrap?.classList.add('hidden');
    if (confirmationInput) confirmationInput.value = '';
    if (confirmationFeedback) confirmationFeedback.textContent = '';
    pendingConfirmation = null;
    lastFocusedElement?.focus();
}

function openConfirmation({ title, message, name = null, action, onConfirm, requireText = null, variant = 'default' }) {
    if (!confirmationModal) {
        onConfirm();
        return;
    }

    lastFocusedElement = document.activeElement;
    confirmationTitle.textContent = title;
    confirmationMessage.textContent = '';
    if (name && message.includes(name)) {
        const [before, after] = message.split(name, 2);
        confirmationMessage.append(document.createTextNode(before));
        const emphasizedName = document.createElement('strong');
        emphasizedName.className = 'font-semibold text-red-900';
        emphasizedName.textContent = name;
        confirmationMessage.append(emphasizedName, document.createTextNode(after));
    } else {
        confirmationMessage.textContent = message;
    }
    confirmationSubmit.textContent = action;
    confirmationPanel?.classList.toggle('border-red-200', variant === 'danger');
    confirmationPanel?.classList.toggle('bg-red-50', variant === 'danger');
    confirmationPanel?.classList.toggle('border-gray-200', variant !== 'danger');
    confirmationPanel?.classList.toggle('bg-white', variant !== 'danger');
    confirmationSubmit.disabled = Boolean(requireText);
    confirmationInputWrap?.classList.toggle('hidden', !requireText);
    if (confirmationInput) confirmationInput.dataset.requiredText = requireText || '';
    pendingConfirmation = onConfirm;
    confirmationModal.classList.remove('hidden');
    confirmationModal.classList.add('flex');
    (requireText ? confirmationInput : confirmationCancel)?.focus();
}

document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (form.dataset.confirmed === 'true') {
            delete form.dataset.confirmed;
            return;
        }

        event.preventDefault();
        openConfirmation({
            title: form.dataset.confirmTitle || 'Please confirm',
            message: form.dataset.confirm,
            name: form.dataset.confirmName || null,
            action: form.dataset.confirmAction || 'Confirm',
            requireText: form.dataset.confirmRequire || null,
            variant: form.dataset.confirmVariant || 'default',
            onConfirm: () => {
                form.dataset.confirmed = 'true';
                form.requestSubmit();
            },
        });
    });
});

confirmationCancel?.addEventListener('click', closeConfirmation);
confirmationModal?.addEventListener('click', (event) => {
    if (event.target === confirmationModal) {
        closeConfirmation();
    }
});
confirmationSubmit?.addEventListener('click', () => {
    if (confirmationSubmit.disabled) return;
    const confirm = pendingConfirmation;
    closeConfirmation();
    confirm?.();
});
confirmationInput?.addEventListener('input', () => {
    const requiredText = confirmationInput.dataset.requiredText;
    const valid = !requiredText || confirmationInput.value === requiredText;
    confirmationSubmit.disabled = !valid;
    if (confirmationFeedback) {
        confirmationFeedback.textContent = confirmationInput.value && !valid
            ? `Type ${requiredText} to continue.`
            : '';
    }
});
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && confirmationModal && !confirmationModal.classList.contains('hidden')) {
        closeConfirmation();
    }

    if (event.key !== 'Tab') {
        return;
    }

    const dialog = [...document.querySelectorAll('[role="dialog"]')]
        .find((element) => !element.classList.contains('hidden'));
    if (!dialog) {
        return;
    }

    const focusable = [...dialog.querySelectorAll('button, input, select, textarea, a[href], [tabindex]:not([tabindex="-1"])')]
        .filter((element) => !element.disabled);
    if (focusable.length === 0) {
        return;
    }

    const first = focusable[0];
    const last = focusable[focusable.length - 1];
    if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        last.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        first.focus();
    }
});

const trackedForms = [...document.querySelectorAll('form[data-track-changes]')];
const dirtyForms = new Set();

trackedForms.forEach((form) => {
    const initialState = new FormData(form);
    const hasChanges = () => {
        const currentState = new FormData(form);
        return JSON.stringify([...currentState.entries()]) !== JSON.stringify([...initialState.entries()]);
    };

    form.addEventListener('input', () => {
        if (hasChanges()) {
            dirtyForms.add(form);
        } else {
            dirtyForms.delete(form);
        }
    });
    form.addEventListener('change', () => {
        if (hasChanges()) {
            dirtyForms.add(form);
        } else {
            dirtyForms.delete(form);
        }
    });
    form.addEventListener('submit', () => dirtyForms.delete(form));
});

function hasDirtyForm() {
    return dirtyForms.size > 0;
}

window.addEventListener('beforeunload', (event) => {
    if (hasDirtyForm()) {
        event.preventDefault();
        event.returnValue = '';
    }
});

document.addEventListener('click', (event) => {
    const link = event.target.closest('a[href]');

    if (!link || link.target === '_blank' || link.hasAttribute('download') || !hasDirtyForm()) {
        return;
    }

    const url = new URL(link.href, window.location.href);
    if (url.href === window.location.href || url.protocol !== window.location.protocol) {
        return;
    }

    event.preventDefault();
    openConfirmation({
        title: 'Discard unsaved changes?',
        message: 'Your edits will be lost if you leave this page.',
        action: 'Discard changes',
        onConfirm: () => {
            dirtyForms.clear();
            window.location.assign(url.href);
        },
    });
});

document.querySelectorAll('form').forEach((form) => {
    form.addEventListener('submit', () => {
        if (form.matches('[data-confirm]') && form.dataset.confirmed !== 'true') {
            return;
        }

        if (form.dataset.submitting === 'true') {
            return;
        }

        form.dataset.submitting = 'true';
        form.setAttribute('aria-busy', 'true');
        form.querySelectorAll('button[type="submit"], input[type="submit"]').forEach((button) => {
            button.disabled = true;
        });
    });
});

const mobileMenuToggle = document.querySelector('[data-mobile-menu-toggle]');
const mobileMenu = document.getElementById('mobile-menu');

function closeMobileMenu() {
    if (!mobileMenu || !mobileMenuToggle) {
        return;
    }

    mobileMenu.classList.add('hidden');
    mobileMenuToggle.setAttribute('aria-expanded', 'false');
    mobileMenuToggle.querySelector('[data-menu-open]')?.classList.remove('hidden');
    mobileMenuToggle.querySelector('[data-menu-close]')?.classList.add('hidden');
}

mobileMenuToggle?.addEventListener('click', () => {
    const isOpen = mobileMenu.classList.toggle('hidden') === false;

    mobileMenuToggle.setAttribute('aria-expanded', String(isOpen));
    mobileMenuToggle.querySelector('[data-menu-open]')?.classList.toggle('hidden', isOpen);
    mobileMenuToggle.querySelector('[data-menu-close]')?.classList.toggle('hidden', !isOpen);
});
mobileMenu?.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeMobileMenu));

const publicToast = document.getElementById('public-toast');
publicToast?.querySelector('[data-dismiss-public-toast]')?.addEventListener('click', () => publicToast.remove());
if (publicToast) {
    window.setTimeout(() => publicToast.remove(), 5000);
}

let rowActionMenu = null;
let rowActionTrigger = null;

function closeRowActionMenu() {
    rowActionMenu?.classList.add('hidden');
    rowActionMenu = null;
    rowActionTrigger?.setAttribute('aria-expanded', 'false');
    rowActionTrigger = null;
}

function openRowActionMenu(trigger) {
    if (rowActionTrigger === trigger) {
        closeRowActionMenu();
        return;
    }

    closeRowActionMenu();
    rowActionTrigger = trigger;
    trigger.setAttribute('aria-expanded', 'true');

    const menu = trigger._rowActionMenu;
    if (!menu) return;
    if (menu.parentElement !== document.body) {
        document.body.appendChild(menu);
    }
    menu.classList.remove('hidden');
    rowActionMenu = menu;

    const bounds = trigger.getBoundingClientRect();
    const menuBounds = menu.getBoundingClientRect();
    const gap = 8;
    const left = Math.min(bounds.left, window.innerWidth - menuBounds.width - gap);
    const top = bounds.bottom + gap + menuBounds.height <= window.innerHeight
        ? bounds.bottom + gap
        : Math.max(gap, bounds.top - menuBounds.height - gap);
    menu.style.left = `${Math.max(gap, left)}px`;
    menu.style.top = `${top}px`;

    menu.querySelectorAll('a, button').forEach((item) => item.addEventListener('click', closeRowActionMenu));
}

document.querySelectorAll('[data-row-action-menu]').forEach((trigger) => {
    trigger._rowActionMenu = trigger.parentElement.querySelector('[data-row-action-popup]');
    trigger.addEventListener('click', () => openRowActionMenu(trigger));
});
document.addEventListener('click', (event) => {
    if (rowActionMenu && !rowActionMenu.contains(event.target) && !event.target.closest('[data-row-action-menu]')) {
        closeRowActionMenu();
    }
});
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeRowActionMenu();
    }
});
window.addEventListener('resize', closeRowActionMenu);
window.addEventListener('scroll', closeRowActionMenu, true);
