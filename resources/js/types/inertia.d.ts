import {User} from './index'
declare module '@inertiajs/core' {
    interface PageProps {
        auth: {user: User}
        flash: {
            toast?: {
                type: 'success' | 'error' | 'warning' | 'info'
                message: string
            }
        }
    }
}