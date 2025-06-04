import { createBrowserRouter } from "react-router-dom";
import AppLayout from "@/components/layouts/AppLayout.tsx";
import App from "@/App.tsx";

const router = createBrowserRouter([
    {
        path: "/",
        element: <AppLayout />,
        children: [
            {
                path: "/",
                element: <App />,
            },
        ],
    },
]);

export default router;
