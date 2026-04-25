export interface User {
    id: number
    name: string
    username: string
    email: string
    phone_number: string | null
    email_verified_at: string | null
    status: 'manager' | 'employee'
    two_factor_confirmed_at: string | null
    shifts?: Shift[]
}
export interface Shift {
    id: number
    user_id: number | null
    start_date: string
    start_time: string
    end_date: string
    end_time: string
    created_at: string
    updated_at: string
    user?: User
}