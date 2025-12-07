<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue'

const props = withDefaults(defineProps<{
    count?: number
    speed?: number
    size?: number
    opacity?: number
}>(), {
    count: 150,
    speed: 1,
    size: 2,
    opacity: 0.8
})

const canvasRef = ref<HTMLCanvasElement | null>(null)
let animationId: number | null = null

class Snowflake {
    x: number
    y: number
    size: number
    speed: number
    wind: number
    opacity: number

    constructor(width: number, height: number, maxSize: number, maxSpeed: number, opacity: number) {
        this.x = Math.random() * width
        this.y = Math.random() * -height
        this.size = Math.random() * maxSize
        this.speed = Math.random() * maxSpeed + 0.5
        this.wind = (Math.random() - 0.5) * 2
        this.opacity = opacity
    }

    update(width: number, height: number, speedFactor: number) {
        this.y += this.speed * speedFactor
        this.x += this.wind

        if (this.y > height) {
            this.y = -10
            this.x = Math.random() * width
        }
        if (this.x > width) this.x = 0
        if (this.x < 0) this.x = width
    }

    draw(ctx: CanvasRenderingContext2D) {
        const { x, y, size, opacity } = this

        // "Тень": чуть больше, сдвинута вниз и вправо, почти прозрачная
        ctx.beginPath()
        ctx.arc(x + 1, y + 1, size + 0.5, 0, Math.PI * 2)
        ctx.fillStyle = `rgba(0, 0, 0, ${opacity * 0.2})`
        ctx.fill()

        // Основная снежинка
        ctx.beginPath()
        ctx.arc(x, y, size, 0, Math.PI * 2)
        ctx.fillStyle = `rgba(255, 255, 255, ${opacity})`
        ctx.fill()
    }
    // draw(ctx: CanvasRenderingContext2D) {
    //     ctx.beginPath()
    //     ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2)
    //     ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`
    //     ctx.fill()
    // }
}

const initSnow = () => {
    const canvas = canvasRef.value
    if (!canvas) return

    const ctx = canvas.getContext('2d')
    if (!ctx) return

    const resizeCanvas = () => {
        canvas.width = window.innerWidth
        canvas.height = window.innerHeight
    }

    window.addEventListener('resize', resizeCanvas)
    resizeCanvas()

    const flakes: Snowflake[] = []
    for (let i = 0; i < props.count; i++) {
        flakes.push(new Snowflake(
            canvas.width,
            canvas.height,
            props.size,
            props.speed,
            props.opacity
        ))
    }

    const animate = () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height)

        for (const flake of flakes) {
            flake.update(canvas.width, canvas.height, props.speed)
            flake.draw(ctx)
        }

        animationId = requestAnimationFrame(animate)
    }

    animate()

    onBeforeUnmount(() => {
        window.removeEventListener('resize', resizeCanvas)
        if (animationId) {
            cancelAnimationFrame(animationId)
        }
    })
}

onMounted(() => {
    initSnow()
})
</script>

<template>
    <canvas ref="canvasRef" class="fixed inset-0 pointer-events-none z-1000" />
</template>

<style scoped>
</style>
