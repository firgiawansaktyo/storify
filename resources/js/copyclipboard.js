import 'flowbite';

window.addEventListener('load', function () {
    const clipboardBCA = FlowbiteInstances.getInstance('CopyClipboard', 'bca-account');
    const $defaultMessageBCA = document.getElementById('default-message-bca');
    const $successMessageBCA = document.getElementById('success-message-bca');

    clipboardBCA.updateOnCopyCallback((clipboardBCA) => {
        showSuccessBCA();

        // reset to default state
        setTimeout(() => {
            resetToDefaultBCA();
        }, 2000);
    })

    const showSuccessBCA = () => {
        $defaultMessageBCA.classList.add('hidden');
        $successMessageBCA.classList.remove('hidden');
    }

    const resetToDefaultBCA = () => {
        $defaultMessageBCA.classList.remove('hidden');
        $successMessageBCA.classList.add('hidden');
    }

    const clipboardMandiri = FlowbiteInstances.getInstance('CopyClipboard', 'mandiri-account');
    const $defaultMessageMandiri = document.getElementById('default-message-mandiri');
    const $successMessageMandiri = document.getElementById('success-message-mandiri');

    clipboardMandiri.updateOnCopyCallback((clipboardMandiri) => {
        showSuccessMandiri();

        // reset to default state
        setTimeout(() => {
            resetToDefaultMandiri();
        }, 2000);
    })

    const showSuccessMandiri = () => {
        $defaultMessageMandiri.classList.add('hidden');
        $successMessageMandiri.classList.remove('hidden');
    }

    const resetToDefaultMandiri = () => {
        $defaultMessageMandiri.classList.remove('hidden');
        $successMessageMandiri.classList.add('hidden');
    }
})