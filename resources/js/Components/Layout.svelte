<script>
    import { inertia } from "@inertiajs/svelte";
    import { cubicIn } from "svelte/easing";
    import { fade, fly } from "svelte/transition";

    let { children, user } = $props();
    let openSidebar = $state(false);
</script>

<svelte:head>
    <title>Matt's Home</title>
    <script src="https://kit.fontawesome.com/0cdd07cc84.js" crossorigin="anonymous"></script>
</svelte:head>

<div class="header">
    <!-- svelte-ignore a11y_consider_explicit_label -->
    <button class="sidebar-button flex align-items-center" onclick={() => openSidebar = !openSidebar}><i class="fa-solid fa-bars" class:hide={openSidebar}></i><i class="fa-solid fa-xmark" class:hide={!openSidebar}></i></button>
    <div class="title-1">Image Goes Here</div>
    {#if openSidebar}
    <div class="sidebar-background" transition:fade={{duration: 200}}></div>
    <div class="sidebar-foreground flex column" in:fly={{x: -window.innerWidth, duration: 200, opacity: 1}} out:fly={{x: -window.innerWidth, duration: 200, opacity: 1, easing: cubicIn}}>
        <a class="title-1" use:inertia href="/" onclick={openSidebar = false}>Home</a>
        {#if user}
            <a class="title-1" use:inertia href="/logout" onclick={openSidebar = false}>Logout</a>
        {:else}
            <a class="title-1" use:inertia href="/login" onclick={openSidebar = false}>Login</a>
        {/if}
    </div>
    {/if}
</div>

{@render children()}

<style lang="scss">
    .header {
        position: sticky;
        top: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 60px rgba(0, 0, 0, 0.2);
        height: 75px;

        * {
            padding: 5px 20px;
        }

        .sidebar-button {
            all: unset;
            cursor: pointer;
            z-index: 9999;
        }

        .sidebar-background {
            width: 100vw;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .sidebar-foreground {
            position: fixed;
            top: 0;
            left: 0;
            width: 400px;
            height: 100vh;
            background-color: white;
            padding-top: 80px;
            gap: 1em;

            @media screen and (max-width: 750px) {
                width: 100vw;
            }
        }
    }

    .title-1 {
        color: black;
        text-decoration: none;
    }
</style>
