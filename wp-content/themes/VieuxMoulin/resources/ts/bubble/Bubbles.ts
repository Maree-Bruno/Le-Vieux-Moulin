import {Circle} from "../framework25/shapes/Circle";
import {iAnimatable} from "../framework25/types/iAnimatable";
import {Vector} from "../framework25/Vector";
import {randomFloat, randomInt} from "../framework25/helpers/random";
import {settings} from "./settings";
import {Hsla} from "../framework25/colors/Hsla";

export class Bubbles extends Circle implements iAnimatable {
    private speed: Vector;
    private readonly canvas: HTMLCanvasElement;
    shouldBeRemoved: boolean;
    private hue: number;

    constructor(ctx: CanvasRenderingContext2D, canvas: HTMLCanvasElement, hue: number) {
        super(ctx, new Vector({
            y: 0,
            x: 0
        }), null, 0);
        this.canvas = canvas;
        this.speed = new Vector({x: 0, y: 0});
        this.hue = hue;
        this.initValues();
    }

    update() {
        this.position.y -= this.speed.y;
        if (this.position.y < -this.radius) {
            this.position.y += this.canvas.height + this.radius;
        }
    }


    animate(): void {
        this.update();
        this.draw();
    }

    private initValues() {
        this.radius = randomInt(settings.minRadius, settings.maxRadius);
        this.color = new Hsla(this.hue, randomInt(40, 100), randomInt(40, 100), randomFloat(0, 0.3));
        this.speed = new Vector({
            x: randomFloat(settings.minSpeed, settings.maxSpeed),
            y: randomFloat(settings.minSpeed, settings.maxSpeed)
        })
        this.position = new Vector({
            y: randomInt(this.canvas.height + this.radius, this.canvas.height / 2 + this.radius),
            x: randomInt(this.radius, this.canvas.width - this.radius)
        });
    }
}