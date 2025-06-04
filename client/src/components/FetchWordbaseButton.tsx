import Button from "@mui/material/Button";
import { type FC, useState } from "react";
import type { WordbaseResponse } from "@/types";
import axios from "axios";
import Typography from "@mui/material/Typography";

const FetchWordbaseButton: FC = () => {
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState<string | null>(null);
    const [message, setMessage] = useState<string | null>(null);

    const fetchWordbase = async (): Promise<void> => {
        setLoading(true);
        setError(null);
        setMessage(null);

        try {
            const response = await axios.get<WordbaseResponse>(
                "http://localhost/api/wordbase/fetch",
                {
                    headers: {
                        "Content-Type": "application/json",
                    },
                },
            );
            setMessage(response.data.message);
        } catch (error) {
            setError(
                error instanceof Error
                    ? error.message
                    : "Failed to fetch the application wordbase.",
            );
        } finally {
            setLoading(false);
        }
    };

    return (
        <>
            <Button
                variant="contained"
                color="warning"
                sx={{ alignSelf: "center", width: "auto" }}
                onClick={fetchWordbase}
                loading={loading}
            >
                Fetch Wordbase
            </Button>
            {message && (
                <Typography
                    variant="body1"
                    color="success"
                    sx={{ alignSelf: "center" }}
                >
                    {message}
                </Typography>
            )}
            {error && (
                <Typography
                    variant="body1"
                    color="error"
                    sx={{ alignSelf: "center" }}
                >
                    {error}
                </Typography>
            )}
        </>
    );
};

export default FetchWordbaseButton;
