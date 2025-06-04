import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import Stack from "@mui/material/Stack";
import FetchWordbaseButton from "./components/FetchWordbaseButton.tsx";
import type { ReactNode } from "react";

export default function App(): ReactNode {
    return (
        <Box
            sx={{
                minHeight: "100vh",
                display: "flex",
                alignItems: "center",
                justifyContent: "center",
            }}
        >
            <Stack spacing={4} direction="column">
                <Typography variant="h3" gutterBottom>
                    Anagram finder
                </Typography>
                <FetchWordbaseButton />
            </Stack>
        </Box>
    );
}
