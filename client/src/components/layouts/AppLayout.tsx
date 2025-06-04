import { Outlet } from "react-router-dom";
import type { ReactNode } from "react";

export default function AppLayout(): ReactNode {
    return (
        <div className="bg-dark">
            <Outlet />
        </div>
    );
}
