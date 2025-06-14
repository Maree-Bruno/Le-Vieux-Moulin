import {Animation} from "./Animation";
import {Bubbles} from "./Bubbles";
import {settings} from "./settings";
import {randomFloat} from "./random";

export class Game {
    private canvas: HTMLCanvasElement;
    private ctx: CanvasRenderingContext2D;
    private animation: Animation;
    private bubble: Bubbles;


    constructor() {
        this.canvas = document.getElementById(settings.canvasID) as HTMLCanvasElement;
        this.ctx = this.canvas.getContext('2d');
        this.resizeCanvas();
        this.animation = new Animation(this.canvas, this.ctx);
        this.addEventListeners();
        this.initBubbles();
        this.animation.start();
        this.manageBubbleLifecycle();
    }

    resizeCanvas() {
        this.canvas.width = innerWidth;
        this.canvas.height = innerHeight;
    }

    private addEventListeners() {
        window.addEventListener('resize', () => {
            this.resizeCanvas();
        });
    }

    private initBubbles() {
        for (let i = 0; i < settings.bubbles; i++) {
            this.animation.registeriAnimatable(new Bubbles(this.ctx, this.canvas, randomFloat(1, 360)));
        }
    }

    private manageBubbleLifecycle() {
        const currentCount = this.animation.iAnimatables.length;
        if (currentCount >= settings.bubbles) {
            // Marque la première bulle pour suppression
            this.animation.iAnimatables[0].shouldBeRemoved = true;

            // Ajoute une nouvelle bulle
            const newBubble = new Bubbles(this.ctx, this.canvas, randomFloat(1, 360));
            this.animation.registeriAnimatable(newBubble);
        }
    }
}