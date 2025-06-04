import { Outlet } from "react-router-dom";

export default function AppLayout(): JSX.Element {
    return (
        <div className="bg-dark">
            <Outlet />
        </div>
    );
}
