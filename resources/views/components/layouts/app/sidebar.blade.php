<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        @livewireStyles
    </head>
    <body class="min-h-screen bg-zinc-200">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-green-800">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group class="grid">
                    @php($role = auth()->user()->role->name ?? '')
                    <flux:navlist.item icon="document-check" :href="route('tramites.lista')" :current="request()->routeIs('tramites.lista')" wire:navigate>{{ __('Lista de Trámites') }}</flux:navlist.item>
                    <flux:navlist.item icon="hand-raised" :href="route('soporte')" :current="request()->routeIs('soporte')" wire:navigate>{{ __('Soporte') }}</flux:navlist.item>
                    @if ($role === 'operador')
                        <flux:navlist.item icon="check-circle" :href="route('verificacionExpediente')" :current="request()->routeIs('verificacionExpediente')" wire:navigate>{{ __('Verificación de expediente') }}</flux:navlist.item>
                        <flux:navlist.item icon="check-circle" :href="route('registroObservaciones')" :current="request()->routeIs('registroObservaciones')" wire:navigate>{{ __('Registro de observaciones') }}</flux:navlist.item>
                        <flux:navlist.item icon="check-circle" :href="route('remisionExpediente')" :current="request()->routeIs('remisionExpediente')" wire:navigate>{{ __('Remision de Expediente') }}</flux:navlist.item>
                        <flux:navlist.item icon="check-circle" :href="route('registroEnvioAutomatico')" :current="request()->routeIs('registroEnvioAutomatico')" wire:navigate>{{ __('Registro de Envio Automatico') }}</flux:navlist.item>
                        <flux:navlist.item icon="check-circle" :href="route('formularioFlujo')" :current="request()->routeIs('formularioFlujo')" wire:navigate>{{ __('Formulario para Flujo') }}</flux:navlist.item>
                        <flux:navlist.item icon="check-circle" :href="route('canalizarEnvio')" :current="request()->routeIs('canalizarEnvio')" wire:navigate>{{ __('Canalizar Expediente') }}</flux:navlist.item>
                        <flux:navlist.item icon="check-circle" :href="route('revisarExpedientesFinalizados')" :current="request()->routeIs('revisarExpedientesFinalizados')" wire:navigate>{{ __('Expedientes Finalizados') }}</flux:navlist.item>
                        <flux:navlist.item icon="check-circle" :href="route('notificacionesSolicitante')" :current="request()->routeIs('notificacionesSolicitante')" wire:navigate>{{ __('Notificaciones Solicitante') }}</flux:navlist.item>
                        <flux:navlist.item icon="check-circle" :href="route('entregarArchivar')" :current="request()->routeIs('entregarArchivar')" wire:navigate>{{ __('Entrega y Archivado') }}</flux:navlist.item>
                        <flux:navlist.item icon="check-circle" :href="route('panelSeguimiento')" :current="request()->routeIs('panelSeguimiento')" wire:navigate>{{ __('Panel de Seguimiento') }}</flux:navlist.item>
                    @endif

                    @if ($role === 'administrador')
                        <flux:navlist.item icon="document-magnifying-glass" :href="route('archivo.central')" :current="request()->routeIs('archivo.central')" wire:navigate>{{ __('Archivo Central') }}</flux:navlist.item>
                        <flux:navlist.item icon="inbox" :href="route('bandeja.entrada')" :current="request()->routeIs('bandeja.entrada')" wire:navigate>{{ __('Bandeja de Entrada') }}</flux:navlist.item>
                        <flux:navlist.item icon="clock" :href="route('tramite.pendiente')" :current="request()->routeIs('tramite.pendiente')" wire:navigate>{{ __('Trámite Pendiente') }}</flux:navlist.item>
                        <flux:navlist.item icon="arrow-right-circle" :href="route('tramite.proceso')" :current="request()->routeIs('tramite.proceso')" wire:navigate>{{ __('Trámite en Proceso') }}</flux:navlist.item>
                        <flux:navlist.item icon="document-check" :href="route('tramite.finalizado')" :current="request()->routeIs('tramite.finalizado')" wire:navigate>{{ __('Trámite Finalizado') }}</flux:navlist.item>
                    @endif
                    @if ($role === 'funcionario')
                        <flux:navlist.item icon="home" :href="route('panel.principal')" :current="request()->routeIs('panel.principal')" wire:navigate>{{ __('Panel principal') }}</flux:navlist.item>
                        <flux:navlist.item icon="document" :href="route('mis.asignaciones')" :current="request()->routeIs('mis.asignaciones')" wire:navigate>{{ __('Mis asignaciones') }}</flux:navlist.item>
                        <flux:navlist.item icon="paper-airplane" :href="route('bandeja.salida')" :current="request()->routeIs('bandeja.salida')" wire:navigate>{{ __('Bandeja de Salida') }}</flux:navlist.item>
                    @endif
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />
            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                        <flux:menu.item :href="route('perfil.editar')" icon="user-circle" wire:navigate>{{ __('Editar Perfil') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                        <flux:menu.item :href="route('perfil.editar')" icon="user-circle" wire:navigate>{{ __('Editar Perfil') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
        @livewireScripts
    </body>
</html>