import {fancybox} from "./fancybox/fancybox";
import {Game} from "./bubble/Game";

fancybox();
window.addEventListener("DOMContentLoaded", () => {
    new Game();
});