import {Fancybox} from "@fancyapps/ui";
export function fancybox() {
    document.addEventListener("DOMContentLoaded", function () {
        Fancybox.bind('[data-fancybox="gallery"]', {});
    });

}
