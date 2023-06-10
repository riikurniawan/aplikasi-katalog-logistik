// change favicon icon to dark mode when web browser using dark mode theme.
matcher = window.matchMedia('(prefers-color-scheme: dark)');
matcher.addListener(onUpdate);
onUpdate();

function onUpdate() {
    lightSchemeIcon = document.querySelector('link#light-scheme-icon');
    darkSchemeIcon = document.querySelector('link#dark-scheme-icon');
    if (matcher.matches) {
    lightSchemeIcon.remove();
    document.head.append(darkSchemeIcon);
    } else {
    document.head.append(lightSchemeIcon);
    darkSchemeIcon.remove();
    }
}